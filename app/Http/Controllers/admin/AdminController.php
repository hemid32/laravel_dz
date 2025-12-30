<?php 
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Traits\GeneralTrait;
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


}


