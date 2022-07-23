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


    public function getuser(Request $request)
     {
        //  $user=JWTAuth::user();

    //     var_dump($user->id);

  

    //     var_dump($user->name);
        
          
        
    //     var_dump($user->email);
       
    //     return $user;
   

    $admin = JWTAuth::user();

    return $admin;

  
       
    }



    public function login(Request $request)
    {
        // $this->validate($request, [
        //     'email' => 'required|email|required|unique:users',
        //     'password' => 'required|min:6'
        //     // regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|
        //     // English uppercase characters (A – Z)
        //     // English lowercase characters (a – z)
        //     // Base 10 digits (0 – 9)
        //     // Non-alphanumeric (For example: !, $, #, or %)
        //     // Unicode characters
        // ]);
        $input = $request->only('email', 'password');
        $token = null;

        if (!$token = JWTAuth::attempt($input)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid Email or Password',
            ], 401);
        }
        $admin = JWTAuth::user();

        return response()->json(compact('token', 'admin'));
        // return response()->json([
        //     'success' => true,
        //     'token' => $token,
        // ]);
    }
    public function logout(Request $request)
    {
        dd($request);
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

        //validation
        // $this->validate($request, [
        //     'email'        =>  'required|email|required|unique:users',
        //     'password' => 'required|min:6|
        //             regex:/^.*(?=.{3,})(?=.*[azA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/|',
        //     'image'        =>  'image|mimes:jpeg,png,jpg,gif|max:3048',


        // ]);
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
        //validation
        // $this->validate($request, [
        //     'email'        =>  'required|email|required|unique',
        //     'image'        =>  'required|image|mimes:jpeg,png,jpg,gif|max:3048',
            // 'password' => ['required', 
            // 'min:6', 
            // 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%]).*$/']
        // ]);

        $post = User::find($id);
        if ($request->input('name')) {
            $post->name = $request->input('name');
            $post->update();
        }
        if ($request->input('email')) {
            $post->email = $request->input('email');
            $post->update();
        }
        if ($request->hasFile('profile_image')) {
            $fileName = $request->profile_image->getClientOriginalName();
            $dateNow = Carbon::now()->toDateTimeString();
            $uniqueFileName = $dateNow . $fileName;
            $request->profile_image->storeAs('uploads', $uniqueFileName, 'public');
            $post->profile_image = $uniqueFileName;
            $post->update();
        }
        return response()->json([$post], 200);



        // $user->update([
        //     'name' => $request->input('name'),
        //     'email' => $request->input('email'),
        
        // ]);
        // $user->save();
        // return $user;
    }

    public function destroy($id)
    {
        return User::destroy($id);
    }

    // public function super($id){
    //     return 
    // }
}
