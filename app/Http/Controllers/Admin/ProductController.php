<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\ProductCategory;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\ProductVarient;
use App\Models\VarientAttribute;
use App\Models\ProductImage;
use App\Models\MetaManagement;

use DB;
use Session;
use Validator;
use Str;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;


class ProductController extends Controller
{
    private $data;
    

    public function __construct()
    {  
        
    }

    public function index(Request $request){

        $data = array();
       
        $filterCategory = $request->input('category', '');
        $data['filterCategory'] = $filterCategory;

        $filterStatus = $request->input('status', '');
        $data['filterStatus'] = $filterStatus;

        
        $data['categories'] = Category::get();
        // dd($data['categories']);

        $query = Product::with('product_categories.categories');

        $data['pname'] = "";
        if($request->has('search')){
            $query->where('product_name', 'like', '%' . $request->get('search') . '%');
            $data['pname'] = $request->get('search');
        }

        if (!empty($filterCategory)) {
            $query->whereHas('product_categories.categories', function ($q) use ($filterCategory) {
                $q->where('category_name', 'like', '%' . $filterCategory . '%');
            });
        }

        if (!empty($filterStatus)) {
            $query->where('status', '=', '%' . $filterStatus . '%');
        }

        $data['products'] = $query->paginate(50);
       

        return view('admin.maincontents.product.index', $data);
    }


    public function create_main()
    {
        $data = array();
        $data['categories'] = Category::get();
        return view('admin.maincontents.product.create_main', $data);
    }


    public function store_main_product(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'product_name'=>'required',
            'slug' => 'required|unique:categories,slug',
            'price' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'categories'=>'required'
        ], []);

        if($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
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

                $image_path = config('constants.PRODUCT_IMAGE_PATH');
                $img->toJpeg(80)->save( public_path($image_path.$image_name) );

            }
            /* ***************************************** */
            /* ***************************************** */

            $slug = Str::slug($request->slug);
            //Insert data into product table
            $save_data = array(
                'product_type' => 'varient',
                'parent_id' => 0,
                'product_name' => $request->product_name,
                'slug' => $slug,
                'description' => $request->description,
                'image' => $image_name,
                'price' => $request->price,
                'status' => 0
            );

            $product = Product::create($save_data);
            $inserted_id = $product->id;

            /* Insert product categories */
            $categories = $request->categories;
            if(!empty($categories)){
                foreach($categories as $category_id){
                    DB::table('product_categories')->insert([
                            'product_id'=>$inserted_id,
                             'category_id'=>$category_id
                    ]);
                }
            }

            return redirect()->route('admin.product.varient', $inserted_id)
                            ->with(['toast'=>'1','status'=>'success','title'=>'Product','message'=>'Success! Product added successfully.']);

            //echo "<pre>"; print_r($submit_data); die();
            
        } catch (Exception $e) {
            DB::rollback(); 
            return back();
        }
        
    }

    public function edit($id){
        
        $data = array();
        $data['categories'] = Category::get();
        $data["product"] = Product::with('product_categories')->find($id);

        $product = Product::with('product_varients')->find($id);
        $data['total_varient'] = $product->product_varients()->count();

        $data['assign_categories'] = $data["product"]->product_categories->pluck('category_id')->toArray();
    
        return view('admin.maincontents.product.edit', $data);
    }


    public function update(Request $request, $id){
        
        $validator = Validator::make($request->all(), [
            'product_name'=>'required',
            'slug' =>'required|unique:products,slug,'.$id.',id',
            'price' => 'required|integer',
            'image' => 'image|mimes:jpeg,png,jpg|max:2048',
            'categories'=>'required'
        ], []);

        if($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        try {

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

                $image_path = config('constants.PRODUCT_IMAGE_PATH');
                $img->toJpeg(80)->save( public_path($image_path.$image_name) );

                //Delete existing image (if any)
                if($request->existing_img !=""){
                    unlink(public_path(config('constants.PRODUCT_IMAGE_PATH').$request->existing_img));
                }

            }
            else{
                $image_name = $request->existing_img;
            }
            /* ***************************************** */
            /* ***************************************** */

            $slug = Str::slug($request->product_name);
            //Insert data into product table
            $product = Product::findOrFail($id);
            $product->product_name  = $request->product_name;
            $product->slug          = $slug;
            $product->sku_code      = $request->sku_code;
            $product->price         = $request->price;
            $product->image         = $image_name;
            $product->description   = $request->description;
            $product->save();

            /* Delete assigned categories */
            ProductCategory::where('product_id', $id)->delete();

            /* Insert new product categories (if any) */
            $categories = $request->categories;
            if(!empty($categories)){
                foreach($categories as $category_id){
                    DB::table('product_categories')->insert([
                            'product_id'=>$id,
                            'category_id'=>$category_id
                    ]);
                }
            }

            return redirect()->route('admin.product.edit', $id)
                            ->with(['toast'=>'1','status'=>'success','title'=>'Product','message'=>'Success! Product updated successfully.']);

            //echo "<pre>"; print_r($submit_data); die();
            
        } catch (Exception $e) {
            DB::rollback(); 
            return back();
        }


    }

    public function change_status(Request $request){
        $product_id = $request->pId;
        $status = $request->sVal;

        $product = Product::findorfail($product_id);
        $product->status = $status;
        $product->save();

        return response()->json(['status'=>'success', 'message'=>'Status Updated successfully.']);
        
    }

    public function delete_image(Request $request){
        $product_id = $request->proId;
        $image_name = $request->imgname;
        
        $product = Product::findOrFail($product_id);
        $product->image = "";
        $product->save();

        if($image_name!=""){
            //Unlink the image from folder
            unlink(public_path(config('constants.PRODUCT_IMAGE_PATH').$image_name));
        }
        
        return response()->json(['status'=>'success', 'msg'=>'Image deleted successfully.']);

    }

    public function delete(Request $request, $id)
    {
        try{
            //soft delete from product, product_varient and varient_attributes tables
            $product = Product::findorfail($id);
            $product_images = $product->product_images()->get();
            //Delete all the product images
            if(!empty($product_images)){
                foreach($product_images as $image){
                    unlink(public_path(config('constants.PRODUCT_IMAGE_PATH').$image->image_name));
                }
            }
            $product->product_images()->delete();
            $product->product_categories()->delete();
            $product->delete();


            return redirect()->route('admin.product.list', $id)
                                ->with(['toast'=>'1','status'=>'success','title'=>'Product','message'=>'Success! Product deleted successfully.']);
        }catch (Exception $e) {
            DB::rollback(); 
            return back();
        }

    }

    public function manage_varient($id)
    {
        $data = array();
        $data["product"] = Product::findorFail($id);
        $attributes = Attribute::with('attribute_values')->get();

        $combination_arr = [];
        $this->arr['color'] = [];
        $this->arr['size'] = [];

        if(!empty($attributes)){
            foreach($attributes as $attribute){
                //Ckeck attribute values
                if(!empty($attribute->attribute_values)){
                    foreach($attribute->attribute_values as $attr_value){
                        $this->arr[strtolower($attribute->attribute_name)][] = array(
                            'attribute_id' => $attribute->id,
                            'attribute_name' => $attribute->attribute_name,
                            'value_id' => $attr_value->id,
                            'value_name' => $attr_value->value_name,
                            'hexa_code' => $attr_value->hexa_color_code
                        );
                    }

                }
            }
        }
        
        //prepare combination based on color and size if both attribute values are defined
        if(!empty($this->arr['color']) && !empty($this->arr['size']))
        {
            foreach($this->arr['size'] as $size){
                foreach($this->arr['color'] as $color){

                    $combination_arr[$size['value_id'].'@'.$size['value_name']][] = array(
                        'color_attribute_id'=> $color['value_id'],
                        'color_text'=> $color['value_name'],
                        'color_code'=> $color['hexa_code']
                    );

                }
            }
        }

        $data['combinations'] = $combination_arr;

        //Prepare existing combination array
        $data["ex_comb"] = DB::table('product_varients as PV')
                            ->leftJoin('varient_attributes as VA', function ($join) use ($id) {
                                $join->on('PV.id', '=', 'VA.product_varient_id')
                                    ->where('PV.product_id', '=', $id);
                            })
                            ->select(DB::raw('GROUP_CONCAT(VA.attribute_value_id ORDER BY VA.id SEPARATOR "#") AS combination'))
                            ->where('PV.deleted_at', '=', NULL)
                            ->where('VA.deleted_at', '=', NULL)
                            ->groupBy('VA.product_varient_id')
                            ->pluck('combination')->toArray();

        //Get list of varient products
        $data['varient_products'] = ProductVarient::with(['varient_attributes.attribute_values','productImages'])->where('product_id', $id)->get(); 
        // echo dd($data['varient_products']);
        // $data['varient_product']=ProductVarient::with(['productImages'])->get();
        // dd($data['varient_product']);
        //echo "<pre>"; print_r($data['combinations']);
        // echo "<pre>"; print_r($data["ex_comb"]);
        // die();

        return view('admin.maincontents.product.varient', $data);

    }

    public function add_varient(Request $request, $product_id)
    {   
        try{
            $product_dtls = Product::findorfail($product_id);
            $attr_value_arr = explode(",", $request->vardtls);

            $product_varient = ProductVarient::create([
                'product_id'    => $product_id,
                'variant_name'  => $product_dtls->product_name,
                'sku_code'      =>'',
                'price'         =>$product_dtls->price,
                'stock_qty'     => 0,
                'status'        => 0,
            ]);

            $varient_id = $product_varient->id;
            if(!empty($attr_value_arr)){
                foreach($attr_value_arr as $value_id){
                    VarientAttribute::create([
                        'product_varient_id' => $varient_id,
                        'attribute_value_id' => $value_id
                    ]);
                }
            }
            
            return redirect()->route('admin.product.varient', $product_id)
                            ->with(['toast'=>'1','status'=>'success','title'=>'Product','message'=>'Success! Product varient created successfully.']);

        }catch (Exception $e) {
            DB::rollback(); 
            return back();
        }
        
    }

    public function update_varient(Request $request, $varient_id)
    {

        $product_varient = ProductVarient::findorfail($varient_id);
        $product_varient->sku_code = $request->sku;
        $product_varient->price = $request->price;
        $product_varient->stock_qty = $request->stock;
        $product_varient->status=$request->status;

        $product_varient->save();

        return response()->json(['status'=>'success', 'msg'=>'Varient updated successfully.']);

    }

    public function image_varient(Request $request, $varient_id)
    {
        $data=array();
        $data['varient_product']=ProductVarient::with(['productImages'])->find($varient_id);
        // dd($data['varient_product']);

        return view('admin.maincontents.product.varient_images', $data);
    }

    public function delete_varient(Request $request, $varient_id)
    {
        //delete from product_varient table
        $product_varient = ProductVarient::findorfail($varient_id)->delete();

        return response()->json(['status'=>'success', 'msg'=>'Varient deleted successfully.']);
    }


    public function manage_images($product_id, $value_id="")
    {
        $data = array();
        $data['value_id'] = $value_id;
        $data['product'] = Product::findorfail($product_id);
        // $data['varient_products'] = ProductVarient::with(['varient_attributes.attribute_values'=> function ($query) {
        //     $query->whereIn('attribute_id', [1, 2]);
        // }])->where('product_id', $product_id)->get();
        $data['products'] = ProductVarient::with(['attributesWithValues', 'productImages.attributeValue'])->where('product_id', $product_id)->get();
        // dd($data['products']);
        $data['product_color_attributes'] = DB::table('varient_attributes AS VA')
                                            ->select('VA.attribute_value_id', DB::raw('MAX(AV.value_name) AS value_name'), DB::raw('MAX(AV.hexa_color_code) AS color_code'))
                                            ->leftJoin('product_varients AS PV', function ($join) use ($product_id) {
                                                $join->on('VA.product_varient_id', '=', 'PV.id')
                                                    ->where('PV.product_id', '=', $product_id);
                                            })
                                            ->leftJoin('attribute_values AS AV', 'VA.attribute_value_id', '=', 'AV.id')
                                            ->where('AV.attribute_id', 1)
                                            ->groupBy('VA.attribute_value_id')
                                            ->get();
        if($value_id!="")                    
            $data["list_images"] = ProductImage::where(['product_id'=>$product_id, 'attribute_value_id'=>$value_id])->get();
        else
            $data["list_images"] = ProductImage::where('product_id', $product_id)->get();
        
            // $data['assign_varient'] = $data["varient_products"]
            // ->flatMap(function ($varient) {
            //     return $varient->varient_attributes->pluck('attribute_id');
            // })
            // ->toArray();     
            // dd($data['assign_varient']);                            
        return view('admin.maincontents.product.images', $data);
        
    }

    public function image_upload(Request $request, $product_id)
    {
        $this->validate($request, [
            'color_attribute'=>'required',
            'iamges' => 'required',
            'iamges.*' => 'required|mimes:jpeg,png,jpg',
            'varents_id' => 'required|array',
            'varents_id.*' => 'required|integer'
        ]);
        
        /* ***************************************** */
        /* ************** Image Upload ************* */
        $images = $request->file('iamges');
        $variant_ids = $request->varents_id;
        // dd($variant_ids);

        foreach ($variant_ids as $variant_id) {
        foreach($images as $image)
        {
            $manager = new ImageManager(new Driver());
            $image_name = hexdec( uniqid() ).'.'.$image->getClientOriginalExtension();
            $img = $manager->read( $image );
            
            $img->scaleDown(width: 450);
            $img->scaleDown(height: 600);

            $image_path = config('constants.PRODUCT_IMAGE_PATH');
            $img->toJpeg(80)->save( public_path($image_path.$image_name) );

            //save records into product_images table
            
            ProductImage::create([
                'product_id' => $product_id,
                'product_varient_id' => $variant_id,
                'attribute_value_id' => $request->color_attribute,
                'image_name' => $image_name,
                'sort_order' => 0
            ]);
          
        }    
    }
       
        /* ***************************************** */
        /* ***************************************** */

        return redirect()->route('admin.product.images', $product_id)
                                ->with(['toast'=>'1','status'=>'success','title'=>'Product','message'=>'Success! Images Uploaded successfully.']);


    }

    public function image_delete(Request $request)
    {
        $image_id = $request->imageId;
        $product_image = ProductImage::findorfail($image_id);
        //unlink image
        unlink(public_path(config('constants.PRODUCT_IMAGE_PATH').$product_image->image_name));
        $product_image->delete();

        return response()->json(['status'=>'success', 'msg'=>'Image deleted successfully.']);
        
    }

    public function manage_meta_details($id)
    {
        $data = array();
        $data['product'] = Product::findorfail($id);
        
        $data['meta_details'] = MetaManagement::where(['section'=>'product', 'item_id'=>$id])->first();
        //dd($data['meta_details']);
        return view('admin.maincontents.product.meta', $data);
    }

    public function update_meta_details(Request $request, $product_id)
    {
        $meta_id = $request->meta_id;
        $validator = Validator::make($request->all(), [
            'meta_title'=>'required',
        ], []);
        if($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }
        try {
        if($meta_id!="") //Record exists, update record
        {
            $product_meta = MetaManagement::findorfail($meta_id);
            $product_meta->meta_title = $request->meta_title;
            $product_meta->meta_keywords = $request->meta_keywords;
            $product_meta->meta_description = $request->meta_description;
            $product_meta->save();            
        }
        else //Meta id not exist, insert record
        {
            $savedata = MetaManagement::create([
                'section' => 'product',
                'item_id' => $product_id,
                'meta_title' => $request->meta_title,
                'meta_keywords' => $request->meta_keywords,
                'meta_description' => $request->meta_description
            ]);

        }
        
        return redirect()->route('admin.product.meta', $product_id)
            ->with(['toast'=>'1','status'=>'success','title'=>'Meta Management','message'=>'Success! Meta details updated successfully.']);
            }
        catch(Exception $e){
            DB::rollback(); 
            return back();
        }
    }

    

    
    

    

    

}
