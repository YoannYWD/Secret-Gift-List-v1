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
        ->select('groups.name', 'users.wish1', 'groups.user_id')
        ->get();
        return view('groups/index', compact('groups'));
    }
}
