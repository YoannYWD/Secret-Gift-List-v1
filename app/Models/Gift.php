<?php

namespace App\Models;
use App\Models\Group;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
        'image',
        'user_id',
        'group_id'
    ];

    //Cardinalité
    public function user() {
        return $this->belongsTo(User::class);
    }
    public function group() {
        return $this->belongsTo(Group::class);
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
