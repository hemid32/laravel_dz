<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    
       protected $fillable = [
         "id_user" , 
         "title" ,
         "image" , 
         "stage" , 
         "id_type_course" 

    ];
}
