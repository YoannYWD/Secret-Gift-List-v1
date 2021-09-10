<?php

namespace App\Models;
use App\Models\User;
use App\Models\Gift;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name'
    ];

    //Cardinalité
    public function user() {
        return $this->hasOne(User::class);
    }
    public function gifts() {
        return $this->hasMany(Gift::class);
    }
}
