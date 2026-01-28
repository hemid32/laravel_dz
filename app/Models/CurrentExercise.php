<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CurrentExercise extends Model
{
    //
protected $fillable = [
         "id_user" ,// hemidi benameur  // user add this course 
         "id_course" ,
         'id_type_course'
    ];
      public function course(){
        return $this->belongsTo(Course::class, 'id' , 'id_course');
    }

}
