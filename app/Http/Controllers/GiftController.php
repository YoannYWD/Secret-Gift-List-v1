<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Gift;

class GiftController extends Controller
{
    //ACCUEIL
    public function index(Request $request) {
        $group_id = $request->group_id;
        $gifts = DB::table('gifts')
        ->join('groups', 'gifts.group_id', '=', 'groups.id')
        ->join('users', 'gifts.user_id', '=', 'users.id')
        ->select('gifts.id', 'gifts.name', 'gifts.price', 'gifts.description', 'gifts.image', 'gifts.user_id', 'users.nickname as user_nickname')
        ->where('gifts.group_id', '=', $group_id)
        ->get();
        return view('gifts/index', compact('group_id', 'gifts'));
    }


    //PAGE CREATE
    public function create(Request $request) {
        $group_id = $request->group_id;
        return view('gifts/create', compact('group_id'));
    }


    //ENREGISTREMENT DU CADEAU
    public function store(Request $request) {
        $imageName = "";
        if ($request->image) {
            $imageName = time() . "." . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
        }
        $newGift = new Gift;
        $newGift->name = $request->name;
        $newGift->price = $request->price;
        $newGift->description = $request->description;
        $newGift->image = '/images/' . $imageName;
        $newGift->user_id = $request->user_id;
        $newGift->group_id = $request->group_id;
        $newGift->save();

        return back()
                         ->with('success', 'Cadeau enregistré !')
                         ->with('image', $imageName);
    }


    //AFFICHAGE PAGE EDITER
    public function edit(Request $request, $id) {
        $group_id = $request->group_id;
        $gift = Gift::findOrFail($id);
        return view('gifts.edit', compact('gift', 'group_id'));
    }


    //EDITER UN CADEAU
    public function update(Request $request, $id) {
        $updateGift = $request->validate([
            'name' => 'required'
        ]);
        $updateGift = $request->except(['_token', '_method']);

        if ($request->image) {
            $imageName = time() . "." . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $updateGift['image'] = '/images/' . $imageName;
        }
        
        Gift::whereId($id)->update($updateGift);
        return back()->with('success', 'Cadeau modifié !');
    }


    //SUPPRESSION DU CADEAU
    public function destroy($id) {
        $gift = Gift::findOrFail($id);
        $gift->delete();
        return back()->with('success', 'Cadeau supprimé !');
    }

}
