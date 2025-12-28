<?php 
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Point;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\GeneralTrait;
use Exception;
use Illuminate\Validation\Rule;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    use GeneralTrait;

    public function register(Request $request)
    {
        try {
         $request->validate([
            'name'     => 'required|string',
            'email'    => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'type' => $request->type  ,  
            'password' => Hash::make($request->password),
        ]);

        $point = Point::create(
            [
                'id_user' => $user->id , 
                 'point' => 0 
                 
            ]
        ) ; 

        $token = JWTAuth::fromUser($user);

        return $this->returnData('data',[
            'user'  => $user,
            'token' => $token
        ],
      'Registered successfully');
    }catch (Exception $e) {
        return $this->returnError('505' , $e->getMessage()) ; 
     }
    
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (! $token = auth()->guard('api')->attempt($credentials)) {
            return $this->returnError('401','معلومات تسجيل الدخول غير صحيحة');
        }

        return $this->returnData( 'data',[
            'token' => $token,
            'user'  => User::with('point')->find(auth('api')->id()),
           //'expires_in' => JWTAuth::factory()->getTTL() * 60
        ], 'Login successful');
    }

    public function me()
    {
        $user = User::with('point')->find(auth('api')->id());

        if($user) {

        return $this->returnData('data',$user, 'User profile');
        }else {
            return $this->returnError('401' , '401 Unauthorized') ;  
        }
    }

    public function logout()
    {
    JWTAuth::invalidate(JWTAuth::getToken());
        return $this->returnData( 'data',[], 'Logged out successfully');
    }


        public function updateProfile(Request $request)
    {
         try {
        // المستخدم المستخرج من JWT
        $user = JWTAuth::parseToken()->authenticate();

        // Validation
        $request->validate([
            'name' => 'nullable|string|max:255',

            // كلمة المرور لا تُطلب إلا عند تغييرها
            'old_password' => 'required_with:new_password|string',
            'new_password' => 'required_with:old_password|string|min:8',

            // النوع فقط 0 أو 1
            'type' => ['nullable', Rule::in([0, 1])],
        ]);

        /** تحديث الاسم فقط */
        if ($request->filled('name')) {
            $user->name = $request->name;
        }

        /** تغيير كلمة المرور */
        if ($request->filled('old_password') && $request->filled('new_password')) {

            if (!Hash::check($request->old_password, $user->password)) {
                return $this->returnError('422' ,'Old password is incorrect' ) ;
            }

            $user->password = Hash::make($request->new_password);
        }

        /** تغيير النوع */
        if ($request->has('type')) {
            $user->type = $request->type;
        }

        $user->save();
        JWTAuth::invalidate(JWTAuth::getToken());
        $newToken = JWTAuth::fromUser($user);
        return $this->returnData('data' , [
            'user'  => $user,
            'token' =>  $newToken
        ]);
    }catch(Exception $e){
        return $this->returnError('67' , $e->getMessage() ) ;  
    }
    }

}
