<?php

namespace App\Http\Controllers;

use Illuminate\Support\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Requests\RegistrationFormRequest;
use Tymon\JWTAuth\Facades\JWTAuth as FacadesJWTAuth;
use App\Http\Middleware\JWTMiddleware;

class AuthController extends Controller
{
    public $loginAfterSignUp = true;


    public function index(Request $request)
    {
        return User::all();
    }


    public function login(Request $request)
    {
        $input = $request->only('email', 'password');
        $token = null;

        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
        return response()->json([
            'success' => true,
            'token' => $token,
        ]);
    }
    public function logout(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        try {
            // JwtAuth::invalidate($request->token);
            auth()->logout();
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);
        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $fileName = $request->profile_image->getClientOriginalName();
        $dateNow = Carbon::now()->toDateTimeString();
        $uniqueFileName = $dateNow . $fileName;
        $request->profile_image->storeAs('uploads', $uniqueFileName, 'public');
        $user->profile_image = $uniqueFileName;
        $user->password = bcrypt($request->password);
        $user->save();

        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }

        return response()->json([
            'success'   =>  true,
            'data'      =>  $user
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
        ]);
        $user->save();
        return $user;
    }

    public function destroy($id)
    {
        return User::destroy($id);
    }

    // public function super($id){
    //     return 
    // }
}
