<?php 

namespace app\Http\Controllers;

use App\Models\User;
// use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Validation\Rule;

// class UserController extends Controller
// {

//     function register(Request $request)
//     {
//         $user = User::create([
//             'email' => $request->input('email'),
//             'password' => Hash::make($request->input('password')),
//         ]);

//         return response()->json(['user' => $user]);
//     }



//     function login(Request $request)
//     {
//         $user = User::where('email', $request->input('email'))->first();

        

//         if($user)
//         {
//             if( Hash::check($request->input('password'), $user->password ) )
//             {
                
//                 $token = Str::random(5);

//                 // $user->update([
//                 //     'token' => $token
//                 // ]);

//                 $user->token = $token;
//                 $user->save();

//                 return response()->json([
//                     'token' => $token
//                 ]);
//             }
//             else {
//                 return response()->json(['error' => 'Incorrect password'], 401);
//             }

//         }
        
//         else {
//             return 'user not found. plz enter correct details';
//         }
//     }


//     function delete ($user)
//     {
        
//         $user = user::find($user);

//         $user->delete();

//         return 'deleted user.';
//     }



//     function update(Request $request, $user)
//     {


//         // $this->validate($request,[
//         //     'email' => 'required|nullable',
//         //     'password' => 'required',
//         // ]);

//         $user = user::find($user); 

//         $user->email =  $request->input('email');
//         $user->password = hash::make($request->input('password'));
//         // $user->save();


//         // $user->update([
//         //     'email' => $req->input('email'),
//         //     'password' => hash::make($req->input('password'))
//         // ]);

        

//         return 'update user';

//     }
    

// }






// JWT AUTH CONTROLLER 




class UserController extends Controller
{
   
    

    function register(Request $request)
        {

            $validate = $this->validate($request,[
                'email' => ['required', 'email', 'unique:users,email'],
                'password' => ['required']
            ]);


            $user = User::create([
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
            ]);

    
            // $user = User::create([
            //     'email' => $validate['email'],
            //     'password' => Hash::make($validate['password']),
            // ]);
    
            return response()->json([
                'status' => 'success',
                'message' => 'user registered',
                'user' => $user
            ]);
        }





   

    public function login()
    {
        $credentials = request(['email', 'password']);

        if (! $token = auth()->attempt($credentials)) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->respondWithToken($token);
    }

    
    public function me()
    {
        return response()->json(auth()->user());
    }

    
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

  
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }




  
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => auth()->factory()->getTTL() * 60
        ]);
    }


}