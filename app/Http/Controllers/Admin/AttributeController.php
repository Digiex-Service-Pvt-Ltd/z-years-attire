<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;
use DB;
use Session;
use Validator;


class AttributeController extends Controller
{
    private $data;
    private $attrMdlObj;

    public function __construct()
    {  
        $this->attrMdlObj = new Attribute;
    }

    public function index(){

        $data = array();
        $data['attributes'] = Attribute::get();
        //dd($data['attributes'] );

        return view('admin.maincontents.attribute.index', $data);
    }

    public function insert(Request $request)
    {   
        $validator = Validator::make($request->all(), [
            'attribute_name'=>'required|max:255',
        ], []);

        if($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        try{

            $record = Attribute::create([
                'attribute_name' => $request->attribute_name
            ]);

            if($record){
                return redirect()->route('admin.attribute.list')->with(['toast'=>'1','status'=>'success','title'=>'Attribute','message'=>'Success! Attribute added successfully.']);
            }else{
                return redirect()->route('admin.attribute.list')->with(['toast'=>'1','status'=>'error','title'=>'Attribute','message'=>'Error! Record Insertion error!']);
            }

        }
        catch(Exception $err){
            return back()->with(['toast'=>'1','status'=>'Error','title'=>'Attribute','message'=>'Error! Something went wrong']);
        }
        
    }

    public function edit($id)
    {
        $data["attribute_details"] = Attribute::findOrFail($id);

        return view('admin.maincontents.attribute.edit', $data);
    }

    public function update(Request $request, $id)
    {   
        $validator = Validator::make($request->all(), [
            'attribute_name'=>'required|max:255',
        ], []);

        if($validator->fails()) {
            return redirect()
                        ->back()
                        ->withErrors($validator)
                        ->withInput();
        }

        //update record
        $attribute = Attribute::findOrFail($id);
        $attribute->attribute_name = $request->attribute_name;
        $record = $attribute->save();

        if($record){
            return redirect()->route('admin.attribute.edit', $id)->with(['toast'=>'1','status'=>'success','title'=>'Attribute','message'=>'Success! Attribute updated successfully.']);
        }else{
            return redirect()->route('admin.attribute.list', $id)->with(['toast'=>'1','status'=>'error','title'=>'Attribute','message'=>'Error! Record Insertion error!']);
        }

    }
    

    

    

}
