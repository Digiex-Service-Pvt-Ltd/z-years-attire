<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use App\Models\AttributeValue;
use DB;
use Session;
use Validator;


class AttributeValueController extends Controller
{
    private $data;
    private $attrMdlObj;

    public function __construct()
    {  
        $this->attrMdlObj = new Attribute;
    }

    public function index($attr_id){
        $data = array();
        $data["attributes"] = Attribute::with('attribute_values')->find($attr_id);
        // echo $attributes->attribute_name."<br>";
        // foreach ($attributes->attribute_values as $value) 
        // {
        //     echo $value->id." - ".$value->value_name."<br>";
        // }
        
        return view('admin.maincontents.attributeValue.index', $data);
    }

    public function insert(Request $request, $attr_id)
    {   
        $validator = Validator::make($request->all(), [
            'value_name'=>'required|max:255',
        ], []);

        if($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        try{

            $hexa_color_code = (!empty($request->hexa_color_code)) ? $request->hexa_color_code : "";

            $record = AttributeValue::create([
                'attribute_id' => $attr_id,
                'value_name' => $request->value_name,
                'hexa_color_code' => $hexa_color_code
            ]);

            if($record){
                return redirect()->route('admin.attributeValue.list', $attr_id)->with(['toast'=>'1','status'=>'success','title'=>'Value','message'=>'Success! Value added successfully.']);
            }else{
                return redirect()->route('admin.attributeValue.list', $attr_id)->with(['toast'=>'1','status'=>'error','title'=>'Value','message'=>'Error! Record Insertion error!']);
            }

        }
        catch(Exception $err){
            return back()->with(['toast'=>'1','status'=>'Error','title'=>'Page Management','message'=>'Error! Something went wrong']);
        }
        
    }

    public function edit($attr_id, $value_id)
    {
        $data["value_details"] = AttributeValue::findOrFail($value_id);

        return view('admin.maincontents.attributeValue.edit', $data);
    }

    public function update(Request $request, $attr_id, $value_id)
    {   
        $validator = Validator::make($request->all(), [
            'value_name'=>'required|max:255',
        ], []);

        if($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        //update record
        $hexa_color_code = (!empty($request->hexa_color_code)) ? $request->hexa_color_code : "";
        $value = AttributeValue::findOrFail($value_id);
        $value->value_name = $request->value_name;
        $value->hexa_color_code = $request->hexa_color_code;
        $record = $value->save();

        if($record){
            return redirect()->route('admin.attributeValue.list', $attr_id)->with(['toast'=>'1','status'=>'success','title'=>'Value','message'=>'Success! Attribute updated successfully.']);
        }else{
            return redirect()->route('admin.attributeValue.list', $attr_id)->with(['toast'=>'1','status'=>'error','title'=>'Value','message'=>'Error! Record Insertion error!']);
        }

    }
    

    

    

}
