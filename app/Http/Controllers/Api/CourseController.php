<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\CompleteCourse;
use App\Models\Course;
use App\Models\Typecourse;
use App\Traits\GeneralTrait;
use Exception;
use GuzzleHttp\ClientTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Facades\JWTAuth;

class CourseController extends Controller
{

    use GeneralTrait;  
    //
    public function completeCourse(Request $request){
        try{
        $user = JWTAuth::parseToken()->authenticate();

        $request->validate([
            'id_course'     => 'required',
        ]);

        CompleteCourse::firstOrCreate(
            [
                'id_user' => $user->id ,   
                'id_course'  => $request->id_course ,  

            ]
        ); 
        return $this->returnSuccessMessage('course is complete') ; 
    }catch(Exception $e){
        return $this->returnError('444' , $e->getMessage()) ; 
    }



            
    }


    //  get all course of types. with complete or not. 
    public function getCoursesOfType(Request $request) {
        try{
        $user = JWTAuth::parseToken()->authenticate();
          $userId = $user->id ;   
    $courses = DB::table('courses')
        ->leftJoin('complete_courses', function ($join) use ($userId) {
            $join->on('courses.id', '=', 'complete_courses.id_course')
                 ->where('complete_courses.id_user', '=', $userId);
        })
            ->where('courses.id_type_course', $request->id_type_course) // 👈 هنا التصفية

        ->select(
            'courses.*',
            DB::raw('CASE WHEN complete_courses.id IS NULL THEN false ELSE true END as isComplete')
        )
        ->get();
        return $this->returnData('data' , $courses) ;   
        }catch(Exception $e) {
            return $this->returnError('444' , $e->getMessage()) ; 
        }

    }


    public function getDetailCourse(Request $request){

                try{
         

                    $idCourse = $request->id_course ;   
    $course = Course::with('content')->findOrFail($idCourse);


        return $this->returnData('data' , $course) ;   
        }catch(Exception $e) {
            return $this->returnError('444' , $e->getMessage()) ; 
        }



    }

    //getTypecourses

        public function getTypecourses(Request $request){

                try{
         

                    $idCourse = $request->id_course ;   
              $types = Typecourse::all();


        return $this->returnData('data' , $types) ;   
        }catch(Exception $e) {
            return $this->returnError('444' , $e->getMessage()) ; 
        }



    }

}
