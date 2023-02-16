<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model{
    protected $table = 'users';
    public $timestamps = true;

    protected $fillable = ['name', 'email'];

    public function tickets(){
        return $this->hasMany(Tickets::class);
    }
}