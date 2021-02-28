<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    public function index()
    {
        $colors = Color::all();
        return view('admin.color.index', compact('colors'));
    }

    public function show(Color $color)
    {
        return view('admin.color.detailed', compact('color'));
    }

    public function create()
    {
        return view('admin.color.create');
    }

    public function store(Request $request)
    {
        
        $request->validate([
            'name'=>'required',
            'hex_color'=> 'required'
        ]);
        Color::create($request->all());
        return redirect()->route('admin.colors.index');
    }

    public function destroy(Color $color)
    {
        $color->delete();
        return redirect()->back();
    }

    public function edit(Color $color){
        return view('admin.color.edit', compact('color'));
    }

    

    public function update(Request $request, Color $color){
        $request->validate([
            'name'=>'required',
            'hex_color'=> 'required'
        ]);
        $color->update($request->all());
        return redirect()->route('admin.colors.index');
    }
}
