<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    //

  protected $fillable = [
         "id_content" ,// hemidi benameur  // user add this Exercies 
         "choice1" ,
         "choice2" , 
         "choice3" , 
         "choice4"  // this is alwayse correct. 
    ];



}
