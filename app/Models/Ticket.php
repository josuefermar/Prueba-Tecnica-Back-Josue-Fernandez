<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ticket extends Model{
    protected $table = 'tickets';
    public $timestamps = true;

    protected $fillable = ['user_id', 'status'];

    public function user(){
        return $this->belongsTo(User::class);
    }
}