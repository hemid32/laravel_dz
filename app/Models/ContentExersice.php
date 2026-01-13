<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContentExersice extends Model
{
    //

     protected $table = "content_exercises" ;  

     protected $fillable = [
         "id_user" ,  // this user is admin or user add this course 
         "id_exercise" ,  
         "def1" , 
         "eq1" ,  
         "img1" ,
         "def2" , 
         "eq2" ,  
         "img2" ,
         "def3" , 
         "eq3" ,  
         "img3" 



    ];

        public function choice(){
        return $this->belongsTo(Choice::class, 'id' , 'id_content');
    }

}
