<?php 
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Traits\GeneralTrait;
use Exception;
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
            'password' => Hash::make($request->password),
        ]);

        $token = JWTAuth::fromUser($user);

        return $this->returnData('data',[
            'user'  => $user,
            'token' => $token
        ],
      'Registered successfully');
    }catch(Exception $e){
        require $this->returnError('data' , $e->getMessage()) ; 
     }
    
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (! $token = auth()->guard('api')->attempt($credentials)) {
            return $this->returnError('401','Invalid credential');
        }

        return $this->returnData( 'data ',[
            'token' => $token,
            'type'  => 'bearer',
           // 'expires_in' => JWTAuth::factory()->getTTL() * 60
        ], 'Login successful');
    }

    public function me()
    {
        return $this->returnData('data',auth('api')->user(), 'User profile');
    }

    public function logout()
    {
    JWTAuth::invalidate(JWTAuth::getToken());
        return $this->returnData( 'data',[], 'Logged out successfully');
    }
}
