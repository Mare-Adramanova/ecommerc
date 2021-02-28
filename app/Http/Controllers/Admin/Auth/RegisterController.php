<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        $users = User::simplePaginate(7);
        
        return view('admin.user.index', compact('users'));
    }

    public function create(){
        return view('admin.user.register');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);
        User::create($request->all());
        return redirect()->route('admin.users.index');
    }
    public function destroy(User $user)
    {
        
        $user->delete();
        return redirect()->back();
    }

    public function show(User $user)
    {
        return view('admin.user.detailed', compact('user'));
    }

    public function orders(User $user)
    {
        $orders = $user->orders;
        
        return view('admin.user.orders', compact('orders', 'user'));
    }
}
