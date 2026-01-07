<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
       protected $fillable = [
         "id_user" ,// hemidi benameur  // user add this course 
         "title" ,
         "image" , 
         "stage" , 
         "id_type_course" 
    ];
      public function content(){
        return $this->belongsTo(ContentCourse::class, 'id' , 'id_course');
    }
}
