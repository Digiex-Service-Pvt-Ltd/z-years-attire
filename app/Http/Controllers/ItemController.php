<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Attribute;
use App\Models\ProductVarient;
use DB;

class ItemController extends Controller
{

    public function __construct()
    {  
        $this->prodMdlObj = new Product;
    }

    public function item_details(Request $request, $product_slug, $varient_id)
    {   
        $data = array();
        $size_attr = $color_attr = [];

        $varient_dtls = ProductVarient::with([
                'attributesWithValues', 
                'productImages.attributeValue'])
                ->findorfail($varient_id)->toArray();
            //echo "<pre>"; print_r($varient_dtls); die();

        $product = Product::with(['product_varients.attributesWithValues'])
        ->where('slug',  $product_slug)->first()->toArray();
        $product_id = $product['id'];
        //dd($product);
        if(!empty($product)){
            if(!empty($product['product_varients'])){
                foreach($product['product_varients'] as $varient){
                    if(!empty($varient['attributes_with_values'])){
                        foreach($varient['attributes_with_values'] as $attribute_values){
                            if($attribute_values['attribute_id'] == 1) //Select color attribute
                            {
                                
                                $selected = ($varient_dtls['attributes_with_values'][1]['id'] == $attribute_values['id']) ? "1" : "0";
                                $color_attr[$attribute_values['id']] = array('id'=>$attribute_values['id'],
                                                'varient_id'=> $varient['id'],
                                                'value_name'=>$attribute_values['value_name'],
                                                'hexa_color_code'=>$attribute_values['hexa_color_code'],
                                                'selected' => $selected
                                            );
                                
                            }
                            
                        }
                    }
                }
            }
        }

        //Prepare size attribute array respaect to selected color attribute
        if(!empty($color_attr) ){
            $selected_color_attr = $varient_dtls['attributes_with_values'][1]['id'];

            $size_respect_to_selected_color = Product::with([
                'product_varients' => function($q) use ($selected_color_attr){
                    $q->whereHas('attributesWithValues', function ($q) use ($selected_color_attr) {
                        $q->where('attribute_value_id', $selected_color_attr);
                        
                    })->with('attributesWithValues.attributes');
                } 
                ])
                ->findorfail($product_id)->toArray();

            if(!empty($size_respect_to_selected_color)){
                if(!empty($size_respect_to_selected_color['product_varients'])){
                    foreach($size_respect_to_selected_color['product_varients'] as $varient){
                        $value_name = $varient['attributes_with_values'][0]['value_name'];
                        $size_attr[] = array(
                            'varient_id'=> $varient['id'],
                            'value_name'=> $value_name,
                            'price' => $varient['price'],
                            'stock_qty' => $varient['stock_qty']
                        );
                    }
                }
            }


        }
        //echo "<pre>"; print_r($varient_filter);
        //echo "<pre>"; print_r($color_attr);
        // echo "<pre>"; print_r($size_attr);
        // die();
        
        $data['product'] = $product;
        $data['varient_dtls'] = $varient_dtls;
        $data['color_attr'] = $color_attr;
        $data['size_attr'] = $size_attr;
        //echo "<pre>"; print_r($data['varient_dtls']); die();

        return view('maincontents/product/details', $data);
            
    }

    
    
}
