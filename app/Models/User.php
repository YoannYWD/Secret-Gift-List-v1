<?php

namespace App\Models;
use App\Models\Group;
use App\Models\Gift;
use App\Models\Comment;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'lastname',
        'firstname',
        'nickname',
        'email',
        'password',
        'wish1',
        'wish2',
        'wish3',
        'wish4',
        'wish5'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Cardinalité
    public function group() {
        return $this->hasOne(Group::class);
    }
    public function gifts() {
        return $this->hasMany(Gift::class);
    }
    public function comments() {
        return $this->hasMany(Comment::class);
    }
}
