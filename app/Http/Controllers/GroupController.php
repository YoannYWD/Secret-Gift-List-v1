<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class GroupController extends Controller
{
    //AFFICHAGE PAGE INDEX
    public function index() {
        $groups = DB::table('groups')
        ->join('users', 'groups.user_id', '=', 'users.id')
        ->select('groups.id', 'groups.name', 'groups.user_id', 'users.wish1')
        ->get();
        return view('groups/index', compact('groups'));
    }
}
