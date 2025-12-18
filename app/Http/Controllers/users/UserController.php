<?php

namespace App\Http\Controllers\users;
use App\Traits\GeneralTrait;
use App\Http\Controllers\Controller;
class UserController extends Controller{
    use GeneralTrait ;  

    public function testApi(){
       return  $this->returnData('data' , ['test' => 'hemidi']) ;  
    }


}