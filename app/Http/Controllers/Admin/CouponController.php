<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = Coupon::all();
       
        return view('admin.coupon.index', ['coupons'=>$coupons]);
    }

    public function create()
    {
        
        return view('admin.coupon.create');
    }

    public function store(Request $request){
        $request->validate([
            'code'=>'required',
            'type' => 'required',
            'value'=> 'nullable',
            'percent_off'=> 'nullable'
            
        ]);

        Coupon::create($request->all());
        return redirect()->route('admin.coupons.index');
    }

    public function destroy(Coupon $coupon)
    {
        $coupon->delete();
        return redirect()->back();
    }

    public function edit(Coupon $coupon)
    {
        return view('admin.coupon.edit', ['coupon'=>$coupon]);
    }

    public function update(Coupon $coupon, Request $request)
    {
        $request->validate([
            'code'=>'required',
            'type' => 'required',
            'value'=> 'nullable',
            'percent_off'=> 'nullable'
            
        ]);
        $coupon->update($request->all());
        return redirect()->route('admin.coupons.index');
    }

    public function show(Coupon $coupon)
    {
        return view('admin.coupon.detailed', ['coupon'=> $coupon]);
    }


}
