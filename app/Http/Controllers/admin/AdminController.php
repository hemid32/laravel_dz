<?php 
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
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






}


