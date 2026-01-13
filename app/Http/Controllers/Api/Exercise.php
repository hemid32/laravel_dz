<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CompleteExercise;
use App\Models\Exercise as ModelsExercise;
use App\Traits\GeneralTrait;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class Exercise extends Controller
{
    //

    use GeneralTrait ;  

       public function completeExercise(Request $request){
        try{
        $user = JWTAuth::parseToken()->authenticate();

        $request->validate([
            'id_exercise'     => 'required',
        ]);

        CompleteExercise::firstOrCreate(
            [
                'id_user' => $user->id ,   
                'id_exercise'  => $request->id_exercise ,  

            ]
        ); 
        return $this->returnSuccessMessage('exercise is complete') ; 
    }catch(Exception $e){
        return $this->returnError('444' , $e->getMessage()) ; 
    }



            
    }




        public function getExerciseOfCourse(Request $request) {
        try{
        $user = JWTAuth::parseToken()->authenticate();
          $userId = $user->id ;   
 $exercises = ModelsExercise::with('content.choice')
    ->leftJoin('complete_exercises', function ($join) use ($userId) {
        $join->on('exercises.id', '=', 'complete_exercises.id_exercise')
             ->where('complete_exercises.id_user', '=', $userId);
    })
    ->where('exercises.id_course', $request->id_course)
    ->select(
        'exercises.*',
        DB::raw('CASE WHEN complete_exercises.id IS NULL THEN false ELSE true END as isComplete')
    )
    ->get();

        return $this->returnData('data' , $exercises) ;   
        }catch(Exception $e) {
            return $this->returnError('444' , $e->getMessage()) ; 
        }

    }



}
