<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CommentController extends Controller
{
    //AFFICHAGE PAGE INDEX + CREATE
    public function create(Request $request) {
        $id = $request->id;
        $gift = DB::table('gifts')
                        ->join('users', 'gifts.user_id', '=', 'users.id')
                        ->select('gifts.id', 'gifts.name', 'gifts.image', 'gifts.price', 'gifts.description', 'gifts.group_id', 'users.nickname as user_nickname')
                        ->where('gifts.id', '=', $id)
                        ->get();
        $comments = DB::table('comments')
                        ->join('users', 'comments.user_id', '=', 'users.id')
                        ->join('gifts', 'comments.gift_id', '=', 'gifts.id')
                        ->select('comments.id', 'comments.content', 'comments.created_at', 'users.nickname as user_nickname')
                        ->where('comments.gift_id', '=', $id)
                        ->get();
        return view('comments/create', compact('gift', 'comments'));
    }

    
    //ENREGISTRER LE COMMENTAIRE
    public function store(Request $request) {
        $newComment = new Comment;
        $newComment->content = $request->content;
        $newComment->user_id = $request->user_id;
        $newComment->gift_id = $request->gift_id;
        $newComment->save();
        return redirect()->route('comments.create')
                        ->with('success', 'Commentaire enregistré !');
    }

}
