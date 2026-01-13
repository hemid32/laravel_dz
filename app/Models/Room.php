<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Room extends Model
{

    protected $fillable = [ 
        'title' , 
        'stage' ,   
        'id_user1' ,  // this is user create this room 
        'id_user2' , 
        'id_user3' , 
        'id_user4'
    ];
    //
}
