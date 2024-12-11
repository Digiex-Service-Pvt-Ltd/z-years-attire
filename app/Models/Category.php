<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'categories';
    protected $primaryKey = 'id';

    protected $fillable = ['category_name', 
                            'slug', 
                            'parent_id', 
                            'image',
                            'is_featured',
                            'sort_order',
                            'filtering_attribute_search', 
                            'status' 
                            ];

    // public function product_categories(){
    //     return $this->hasOne(ProductCategory::class, 'category_id', 'id');
    // }

    public function product_categories()
    {
        return $this->hasMany(ProductCategory::class,'category_id', 'id');
    }

    public static function getFormattedCategory($search_params=array())
    {
        // Step 1: Create temporary table tmp_menuid
        DB::statement('CREATE TEMPORARY TABLE IF NOT EXISTS tmp_menuid (
            id INT AUTO_INCREMENT PRIMARY KEY,
            menuid INT
        );
        ');

        // Step 2: Truncate tmp_menuid
        DB::table('tmp_menuid')->truncate();

        // Step 3: Insert into tmp_menuid
        DB::insert("insert into tmp_menuid(menuid)
        SELECT menu_id FROM 
        (
        SELECT DISTINCT SUBSTRING_INDEX(SUBSTRING_INDEX(t2.all_ids, ',', t1.id), ',', -1) as menu_id
        FROM incr_mst as t1
        JOIN 
        (
        SELECT group_concat(all_id) as all_ids FROM
        (
        SELECT 
            m1.id AS level1_id,
            m1.category_name AS level1_name,
            m2.id AS level2_id,
            m2.category_name AS level2_name,
            m3.id AS level3_id,
            m3.category_name AS level3_name,
            m4.id AS level4_id,
            m4.category_name AS level4_name
            ,   CONCAT_WS(',', m1.id, IFNULL(m2.id, ''), IFNULL(m3.id, ''), IFNULL(m4.id, '')) AS all_id
        
        FROM 
            categories m1
        LEFT JOIN 
            categories m2 ON m2.parent_id = m1.id
        LEFT JOIN 
            categories m3 ON m3.parent_id = m2.id
        LEFT JOIN 
            categories m4 ON m4.parent_id = m3.id
        
        WHERE 
            m1.parent_id = 0
        ORDER BY 
            m1.id,m1.sort_order, m2.id,m2.sort_order, m3.id,m3.sort_order, m4.id,m4.sort_order
            ) as t1
            ) as t2
            ) as t3 where t3.menu_id!=''");

        // Step 4: Select data from categories and join with tmp_menuid
        $results = DB::select("SELECT t1.id,
                                t1.parent_id,
                                t1.category_name as text,
                                t1.slug,
                                t1.sort_order,
                                t1.deleted_at
                                FROM categories as t1 
                    JOIN tmp_menuid as t2 ON t1.id = t2.menuid AND t1.deleted_at IS NULL 
                    ORDER BY t1.sort_order");
        
        return $results;

    }
    
    public function saveItems(array $items, $parentId = 0)
    {
        if(!empty($items))
        {
            $sort_order = 0;
            foreach ($items as $item) {
                $sort_order = $sort_order + 1;
                DB::table('categories')
                    ->where('id', $item['id'])
                    ->update(['parent_id'=>$parentId, 'sort_order'=>$sort_order]);

                if (isset($item['children'])) {
                    self::saveItems($item['children'], $item['id']);
                }
            }
        }

    }

    // Recursive function to retrieve all child IDs
    public static function getAllChildIds($id)
    {
        $children = [];
        
        // Find all direct children of the given ID
        $directChildren = DB::table('categories')->where('parent_id', $id)->get();

        foreach ($directChildren as $child) {
            // Add the child's ID to the array
            $children[] = $child->id;
            // Recursively find all children of the current child
            $children = array_merge($children, self::getAllChildIds($child->id));
        }

        return $children;
    }

    public static function delete_category($idsArr = array()){

        DB::beginTransaction();
        try{
            if(is_array($idsArr) && !empty($idsArr)){
                foreach($idsArr as $id){
                    //unlink category image file
                    $catObj = new Category;
                    $category = $catObj::findorfail($id);
                    $image_path = config('constants.CATEGORY_IMAGE_PATH');
                    if($category->image != ""){
                        unlink(public_path($image_path.$category->image));
                    }
                    $category->delete();
                    //Delete records from meta table
                    DB::table('meta_management')
                        ->where(['section'=>'category', 'item_id'=>$id])
                        ->delete();
                }
            }
            // Commit the transaction
            DB::commit();
        }
        catch(\Exception $e){

            // Rollback the transaction
            DB::rollBack();
            
            throw $e;
        }

    }

}
