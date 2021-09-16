<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class LoginController extends Controller
{

    public function link()
    {
        return view("registeration.connexion");
    }

    public function indexUpdate()
    {
        return view("registeration.update");
    }


    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember_me = $request->has('remember') ? true : false;
        if (Auth::attempt($credentials, $remember_me)) {
            $request->session()->regenerate();
            return redirect()->to('/home');
        }

        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function update(Request $request)
    {
        $userId = Auth::id();
        $user = User::findOrfail($userId);

        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:225|'. Rule::unique('users')->ignore($user->id),
            'password' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $user->fill([
            'name' => $request->name,
            'email' => $request->email, 
            'password' => $request->password,
        ]);

        $user->save();
        return back()
        ->with('success', 'Votre profil à bien été modifié.');
    }

    public function logout(Request $request)
    {
        
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->to('/login');
    }
}
