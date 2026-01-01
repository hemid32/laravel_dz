<?php 
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\ContentCourse;
use App\Models\Course;
use App\Models\typecourse;
use App\Traits\GeneralTrait;
use Exception;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AdminController extends Controller {

    use GeneralTrait ;  

    public function loginView() {
        return View('admin/login') ; 
    }


    public function logout() {
      Auth::logout();
      return redirect()->route('login')    ->with('message', 'تم تسجيل الخروج بنجاح');
;
     //   return View('') ; 

    }




public function login(Request $request)
{


    $request->validate([
        'email' => 'required|email',
        'password' => 'required'
    ]);

    $credentials = $request->only('email', 'password');


    if (!Auth::attempt($credentials)) {
            return redirect()->back()->with(['message' => 'Invalid email or password']);
    }

    if (Auth::user()->role !== 'admin') {
        Auth::logout();
            return redirect()->back()->with(['message' => 'غير مصرح لك الدخول لهنا']);
    }


    //return response()->json([
    //    'success' => true,
     //   'message' => 'Admin login successful',
    //]);
    return redirect()->route('admin.dashboard');



}


public function typecourse(){

    return view('admin/typecourse') ;  
}



public function typesave(Request $request){
     try {


           
           $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:5120',
        ]);

       $imagePath = $request->file('image')->store('courses', 'public');
        Typecourse::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('message', 'Type courses saved successfully');
    //return redirect()->route('admin.dashboard');
    }catch(Exception $e){

        return redirect()->back()->with('message', $e->getMessage());


    }

}


public function contentcourse(){
        $courses = Course::all();

    return view('admin/contentcourse', compact('courses')) ;   
}


public function course(){
        $typeCourses = Typecourse::all();

    return view('admin/course', compact('typeCourses')) ;   
}



public function coursesave(Request $request){

  try{


           $imagePath1 = null;
if ($request->hasFile('image')) {
    $imagePath1 = $request->file('image')->store('courses', 'public');
}


      $user = Auth::user();

     Course::create([
            'id_user' => $user->id,  
            'id_type_course'=> $request->type_course_id, 
            'title' => $request->title,
            'image' => $imagePath1,
            'stage'=> $request->stage , 

        ]);



                return redirect()->back()->with('message', 'content course saved successfully');
                }catch(Exception $e) {
                    return redirect()->back()->with('message' , $e->getMessage()) ;  
}

}






public function contentcoursesave(Request $request){

  try{


           $imagePath1 = null;
if ($request->hasFile('img1')) {
    $imagePath1 = $request->file('img1')->store('courses', 'public');
}

 $imagePath2 = null;
if ($request->hasFile('img2')) {
    $imagePath2 = $request->file('img2')->store('courses', 'public');
}

 $imagePath3 = null;
if ($request->hasFile('img3')) {
    $imagePath3 = $request->file('img3')->store('courses', 'public');
}

      $user = Auth::user();

     ContentCourse::create([
            'id_user' => $user->id,  
            'id_course' => $request->course_id,    
            'def1' => $request->def1,
            'eq1' => $request->eq1,
            'img1'=> $imagePath1 , 
            'def2' => $request->def2,
            'eq2' => $request->eq2,
            'img2'=> $imagePath2 , 
            'def3' => $request->def3,
            'eq3' => $request->eq3,
            'img3'=> $imagePath3

        ]);



                return redirect()->back()->with('message', 'content course saved successfully');
                }catch(Exception $e) {
                    return redirect()->back()->with('message' , $e->getMessage()) ;  
}

}







}


