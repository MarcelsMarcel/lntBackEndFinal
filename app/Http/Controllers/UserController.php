<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    //Login
    function login(Request $request) {
        //Validasi input
        $credentials = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        //attempt login
        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if($user->role == 'admin') {
                return redirect()->route('admin.home');
            } else {
                return redirect()->route('user.home');
            }
        }

        return back();
    }
    //Register
    function register(Request $request) {
        //Validasi input
        $request->validate([
            'name' => 'required|unique:users,name',
            'password' => 'required|min:6|confirmed',
            'role' => 'required'
        ]);
        //Store ke database
        User::create([
            'name' => $request->name,
            'password' => Hash::make($request->password),
            'role' =>$request->role
        ]);
        //Redirect ke login
        return redirect()->route('login');
    }

    //Logout
    function logout() {
        Auth::logout();

        return redirect()->route('login');
    }

    public function showTopUpForm()
{
    return view('user.topup'); // You'll create this view
}

public function topUp(Request $request)
{
    $request->validate([
        'amount' => 'required|numeric|min:1'
    ]);

    $user = Auth::user();
    $user->money += $request->amount;
    $user->save();

    return redirect()->route('user.home')->with('success', 'Top up successful!');
}

}
