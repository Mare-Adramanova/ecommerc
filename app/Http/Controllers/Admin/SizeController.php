<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ColorProductSize;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sizes = Size::all();
        return view('admin.size.index', compact('sizes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Size $size)
    {
        return view('admin.size.create', compact('size'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        Size::create($request->all());
        return redirect()->route('admin.sizes.index');
    }

    /**
     * Display the specified resource.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function show(Size $size)
    {
        return view('admin.size.detailed', compact('size'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * 
     * @return \Illuminate\Http\Response
     */
    public function edit(Size $size)
    {
        return view('admin.size.edit', compact('size'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Size $size)
    {
        $request->validate([
            'name'=> 'required'
        ]);
        $size->update($request->all());
        return redirect()->route('admin.sizes.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Size $size)
    {
        $size->delete();
        return redirect()->route('admin.sizes.index');
    }

    public function get_by_color(Request $request){
     
        if(!$request->color){
            $html = '<option value="">'.trans('global.pleaseSelect').'</option>';
        }else{
            $color = $request->color;
            $product = $request->prodId;
            $html = '';
            $sizes = ColorProductSize::where('color_id', $color)->where('product_id', $product)->get();
            
            foreach($sizes as $size){
                $size_name = Size::where('id', $size->size_id)->first();
                $name = $size_name->name;
                 $html .= '<option value="'.$size->size_id.'">' .$name ; 
                 echo $size_name->name;
                 echo $size->size_id;
               
             }
          }
        return response()->json(['html' => $html]);
    }
}
