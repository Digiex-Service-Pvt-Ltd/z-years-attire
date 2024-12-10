<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Attribute;
use App\Models\MetaManagement;
use App\Common\Utils;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use DB;
use Session;
use Validator;
use Str;


class CategoryController extends Controller
{
    private $data;
    private $catMdlObj;

    public function __construct()
    {  
        $this->catMdlObj = new Category;
    }

    public function index(Request $request){

        $this->data = array();

        //Submitted form data
        if($request->post())
        {
            
            $validator = Validator::make($request->all(), [
                'category_name' => 'required',
                'slug' => 'required|unique:categories,slug',
                'image' => 'image|mimes:jpeg,png,jpg|max:2048',
                'is_featured' => 'required',
                'status' => 'required'
            ]);

            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withinput();
            }

            try {

                /* ***************************************** */
                /* ************** Image Upload ************* */
                $image = $request->file('image');
                $image_name = "";
                if($image)
                {
                    
                    $manager = new ImageManager(new Driver());
                    $image_name = hexdec( uniqid() ).'.'.$image->getClientOriginalExtension();
                    $img = $manager->read( $image );
                    
                    $img->scaleDown(width: 450);
                    $img->scaleDown(height: 600);

                    $image_path = config('constants.CATEGORY_IMAGE_PATH');
                    $img->toJpeg(80)->save( public_path($image_path.$image_name) );

                }
                /* ***************************************** */
                /* ***************************************** */

                $filtering_search = (!empty($request->filtering_attribute_search)) ? json_encode($request->filtering_attribute_search) : "";
                
                $q = DB::table('categories')
                            ->selectRaw('max(sort_order) as sort_order')
                            ->where(['parent_id'=>$request->parent_id])
                            ->first();
                $sort_order = ($q->sort_order) +1;

                $slug = Str::slug($request->slug);

                //Insert data into category table
                $save_data = array(
                    'category_name' => $request->category_name,
                    'slug' => $slug,
                    'parent_id' => $request->parent_id,
                    'image' => $image_name,
                    'is_featured' => $request->is_featured,
                    'sort_order' => $sort_order,
                    'filtering_attribute_search' => $filtering_search,
                    'status' => $request->status
                );
 
                $category = Category::create($save_data);
                $inserted_id = $category->id;

                //Insert data into meta table
                $meta_data = array(
                    'section' => 'category',
                    'item_id' => $inserted_id,
                    'meta_title' => $request->meta_title,
                    'meta_keywords' => $request->meta_keywords,
                    'meta_description' => $request->meta_description
                );
                
                $meta = MetaManagement::create($meta_data);

                return redirect()->route('admin.category.list')
                                ->with(['toast'=>'1','status'=>'success','title'=>'Menu Setup','message'=>'Success! Category added successfully.']);

                //echo "<pre>"; print_r($submit_data); die();
                
            } catch (Exception $e) {
                DB::rollback(); 
                return back();
            }
            
        }
        
        $this->data['title'] = 'New Category';
        $search_params = array('status'=>'active');
        $this->data['listCategory'] = Utils::getCategoryTreeArray($search_params);
        //dd($this->data['listCategory']); die();
        
        $categorylist = DB::table('categories')->where('status', 1)->get()->toArray();
        $this->data['category_list'] = $categorylist;

        $this->data['attributes'] = Attribute::get();
        //echo "<pre>"; print_r( $this->data['attributes'] ); die();

        
        return view('admin.maincontents.category.generate', $this->data);

    }

    public function save_changes(Request $request)
    {   
        $menuArr = json_decode($request->output_string, true);
        //echo "<pre>"; print_r($menuArr); die();

        //Sort order field set to 0 for all menus
        DB::table('categories')->update(['sort_order'=>0]);

        $this->catMdlObj->saveItems($menuArr);
        //-------- Overwrite the menu list session variable --------//
        $search_params = array('status'=>'active');
        $updatedMenuListArr = Utils::getCategoryTreeArray($search_params);
        Session::put('menulistArr', $updatedMenuListArr);
        // -------------------------------------------------------- //
        
        return redirect()->route('admin.category.list')
                                ->with(['toast'=>'1','status'=>'success','title'=>'Menu Setup','message'=>'Success! Menu changes successfully updated.']);
    }

    public function get_details($id)
    {
        $data = array();
        
        $data["cat_details"] = DB::table('categories')
                                    ->leftjoin('meta_management', function($join){
                                        $join->on('categories.id', '=', 'meta_management.item_id')
                                            ->where('section','=', 'category');
                                    })->where(['categories.id'=>$id])
                                    ->selectRaw("categories.*, 
                                             meta_management.meta_title,
                                             meta_management.meta_keywords,
                                             meta_management.meta_description")
                                    ->first();
        //dd($data["cat_details"]);
        $data['attributes'] = Attribute::get();                            

        $str_html = view('admin.maincontents.category.edit', $data )->render();
        return response()->json($str_html);
    }

    public function update_category(Request $request){
        
        $category_id = $request->id;
        
        $validator = Validator::make($request->all(), [
            'category_name' => 'required',
            'slug' =>'required|unique:categories,slug,'.$category_id.',id',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'is_featured' => 'required',
            'status' => 'required'
        ]);

        if($validator->fails()){
            return response()->json(['status' => 'failed', 'errors' => $validator->errors(), 'msg'=>'']);
        }
        
        /* ***************************************** */
        /* ************** Image Upload ************* */
        $image = $request->file('image');
        if($image)
        {  
            $manager = new ImageManager(new Driver());
            $image_name = hexdec( uniqid() ).'.'.$image->getClientOriginalExtension();
            $img = $manager->read( $image );
            
            $img->scaleDown(width: 450);
            $img->scaleDown(height: 600);

            $image_path = config('constants.CATEGORY_IMAGE_PATH');
            $img->toJpeg(80)->save( public_path($image_path.$image_name) );

            //Delete existing image (if any)
            if($request->existing_img !=""){
                unlink(public_path(config('constants.CATEGORY_IMAGE_PATH').$request->existing_img));
            }

        }else{
            $image_name = $request->existing_img;
        }
        /* ***************************************** */
        /* ***************************************** */

        $slug = Str::slug($request->slug);

        $filtering_search = (!empty($request->filtering_attribute_search)) ? json_encode($request->filtering_attribute_search) : "";

        $category = Category::findOrFail($category_id);
        $category->category_name = $request->category_name;
        $category->slug          = $slug;
        $category->image         = $image_name;
        $category->is_featured   = $request->is_featured;
        $category->filtering_attribute_search   = $filtering_search;
        $category->status        = $request->status;
        $category->save();

        $meta_update = MetaManagement::where(['section'=>'category', 'item_id'=>$category_id])->first();
        if($meta_update)
        {
            $meta_update->meta_title = $request->meta_title;
            $meta_update->meta_keywords = $request->meta_keywords;
            $meta_update->meta_description = $request->meta_description;
            $meta_update->save();
        }

        // ------- Update status of all the childs -------- //
        Category::where('parent_id', $category_id)->update(['status'=>$request->status]);

        return response()->json(['status' => 'success', 'errors'=>'', 'msg' => 'Record updated successfully!']);
    }

    public function delete_category(Request $request){

        try{
            $cat_id = $request->catId;
            
            $getAllIds = $this->catMdlObj->getAllChildIds($cat_id);
            if(!empty($getAllIds)) //Child menu exists under this selected menu
            {
                array_push($getAllIds, (int) $cat_id); //Push the selected id into the array
                $this->catMdlObj->delete_category($getAllIds);
            }
            else //Submenu does not exists
            {
                $this->catMdlObj->delete_category(array($cat_id));
            }

            return response()->json(['response_code'=>200, 'message' => 'Selected Category and its child(s) has been deleted successfully!']);

        }catch(\Exception $e){
            return response()->json(['response_code'=>500, 'message' => $e->getMessage()]);
        }
            
    }

    public function delete_image(Request $request){
        $category_id = $request->catId;
        $image_name = $request->imgname;
        
        $category = Category::findOrFail($category_id);
        $category->image = "";
        $category->save();

        if($image_name!=""){
            //Unlink the image from folder
            unlink(public_path(config('constants.CATEGORY_IMAGE_PATH').$image_name));
        }
        
        return response()->json(['status'=>'success', 'msg'=>'Image deleted successfully.']);


    }

}
