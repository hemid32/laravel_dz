<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Exercise extends Model
{
    //
   protected $fillable = [
         "title" , 
         "image" ,  
         "id_course" ,
         "stage" , 
         'time' ,  
         "id_user" , 
    ];

    public function content(){
        return $this->belongsTo(ContentExersice::class, 'id' , 'id_exercise');
    }

}
