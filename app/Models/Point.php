<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Point extends Model
{

    protected $fillable = [
         "id_user" , 
         "point" , 

    ];


        protected  function casts(){
        return [
            "id_user" => "int" , 
            "point" => "int" ,  
            
        ] ; 

    }


      public function user(){
        return $this->belongsTo(Point::class, 'id_user');

    }






    //
}
