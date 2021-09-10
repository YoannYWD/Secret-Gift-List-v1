<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    public function index() {
        return view('auth.login');
    }

    public function userLogin(Request $request) {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            return redirect()->intended('/accueil')
                             ->with('success', 'Utilisateur connecté.');
        }

        return redirect('/accueil/login')->with('success', 'Votre email ou mot de passe est incorrect.');
    }

    public function registration() {
        return view('auth.registration');
    }

    public function userRegistration(Request $request) {
        $request->validate([
            'lastname' => 'required',
            'firstname' => 'required',
            'nickname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6'
        ]);

        $data = $request->all();
        $this->createUser($data);

        $id = DB::getPdo()->lastInsertId();
        $this->createGroup($data, $id);

        return redirect('/accueil/login')->with('success', 'Vous êtes enregistré.');
    }

    public function createUser(array $data) {
        return User::create([
            'lastname' => $data['lastname'],
            'firstname' => $data['firstname'],
            'nickname' => $data['nickname'],
            'email' => $data['email'],
            'password' => Hash::make($data['password'])
        ]);
    }

    public function createGroup(array $data, $id) {
        return Group::create([
            'name' => $data['firstname'],
            'user_id' => $id,
        ]);
    }

    public function dashboard() {
        if(Auth::check()) {
            return view('groups/index');
        }
        return redirect('auth/login')->with('success', "Vous n'êtes pas connecté.");
    }

    public function signOut() {
        Session::flush();
        Auth::logout();

        return redirect('accueil');
    }
}
