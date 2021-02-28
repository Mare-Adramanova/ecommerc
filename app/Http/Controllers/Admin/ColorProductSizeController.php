<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ColorProductSize;
use Illuminate\Http\Request;

class ColorProductSizeController extends Controller
{
    public function index()
    {
        $variations = ColorProductSize::simplePaginate(10);
        return view('admin.variation.index', compact('variations'));
    }

    public function create()
    {
        return view('admin.variation.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id'    =>  'required',
            'color_id'     =>  'required',
            'size_id' => 'required',
            'quantity'         =>  'required'
        ]);
        ColorProductSize::create($request->all());
        return redirect()->route('admin.productVariations.index');

    }

    public function destroy(ColorProductSize $variation)
    {
        $variation->delete();
        return redirect()->back();
    }


}
