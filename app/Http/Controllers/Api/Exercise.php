<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CompleteExercise;
use App\Models\Course;
use App\Models\CurrentExercise;
use App\Models\Exercise as ModelsExercise;
use App\Models\Point;
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



    public function getCurrentExercise( Request $request ){
       
    try{
                 $user = JWTAuth::parseToken()->authenticate();

    $exists = CurrentExercise::
    where('id_user', $user->id)
    ->where('id_type_course', $request->id_type_course)
    ->exists();

    if (!$exists) {
    $course = Course:: 
        where('id_type_course', $request->id_type_course)
        ->orderBy('stage', 'asc')
        ->first();
    return  $this->returnData('data' , $course); // قد يكون null إذا لا يوجد أي كورس
    }
// المرحلة الحالية
$currentStage = CurrentExercise::join('courses', 'courses.id', '=', 'current_exercises.id_course')
    ->where('current_exercises.id_user', $user->id)
    ->where('current_exercises.id_type_course', $request->id_type_course)
    ->value('courses.stage');
// الكورس التالي
$course_result =  Course::where('id_type_course', $request->id_type_course)
    ->where('stage', '>', $currentStage)
    ->orderBy('stage', 'asc')
    ->first(); // null إذا لا يوجد التالي
      
  return $this->returnData('data' , $course_result) ;   

    }catch(Exception $e) {
     return $this->returnError('error' , $e->getMessage()) ;   
    }


    }
    
    public function currentExerciseSave(Request $request){
          
        try{
        $user = JWTAuth::parseToken()->authenticate();

        $request->validate([
            'id_course' => 'required',
            'id_type_course' => "required" ,  
        
        ]);

        CurrentExercise::updateOrCreate(
            [
                'id_course' => $request->id_course ,  
                'id_user' => $user->id  ,   
            ] , 
            [
                'id_user' => $user->id ,   
                'id_course'  => $request->id_course ,  
                'id_type_course' => $request->id_type_course 

            ]
        ); 
        return $this->returnSuccessMessage('we change current curse to new') ; 
    }catch(Exception $e){
        return $this->returnError('444' , $e->getMessage()) ; 
    }
    }


    public function savePoint(Request $request) {
                try{
        $user = JWTAuth::parseToken()->authenticate();

        $request->validate([
            'point'     => 'required',
        ]);
        $points = (int) $request->point;
        $query = Point::where('id_user', $user->id);

        if ($points < 0) {
         $query->where('point', '>=', abs($points));
         }
        $updated = $query->update([
            'point' => DB::raw("point + ($points)")
        ]);

       if ($updated === 0) {
        return  $this->returnError('45' , 'الرصيدغير كافي');
        }


        return $this->returnData('data' , Point::where('id_user', $user->id)->value('point')); 
    }catch(Exception $e){
        return $this->returnError('444' , $e->getMessage()) ; 
    }

    }







}
