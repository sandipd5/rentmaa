<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Validator;
use DB, Hash, Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\Mail\Message;
use App\Role;
//use Auth;
class RegistrationController extends Controller
{
    //
    public function index()
    {
    	return User::all();
    	//return Role::all();
    }

   public function show (user $user)
   {
   	    return $user;
       
   }

   public function register(Request $request)
   {
   	 $rules=
   	         [
   	            'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|confirmed|min:6',
   	         ];
   	  $input = $request->only(
            'name',
            'email',
            'password',
            'password_confirmation',
            'phone',
            'address'
        );  

        $validator = Validator::make($input, $rules); 

        if($validator->fails()) {
            $error = $validator->messages()->toJson();
            return response()->json(['success'=> false, 'error'=> $error]);
        }
   	     $user=new user;
   	     $name=$request->name;
   	     $email=$request->email;
   	     $password=$request->password;

   	     $phone=$request->phone;
   	     $address=$request->address;
   	     $user = User::create(['name' => $name, 'email' => $email, 'password' => Hash::make($password),'phone'=> $phone,'address'=> $address]);
         $user->Roles()->attach(Role::where('title','User')->first());
         
   	    

   	     //   $user->roles()->attach(Role::where('name', 'superadmin')->first());
           //  return $user;

   	     $verification_code = str_random(30); //Generate verification code

   	     DB::table('user_verifications')->insert(['user_id'=>$user->id,'token'=>$verification_code]);
   	     $subject = "Please verify your email address.";
   	     Mail::send('email.verify', ['name' => $name, 'verification_code' => $verification_code],
   	     function($mail) use ($email, $name, $subject){
                $mail->from(getenv('MAIL_FROM'), "hello@rentmaa.com");
                $mail->to($email, $name);
                $mail->subject($subject);
            });
   	      return response()->json(['success'=> true, 'message'=> 'Thanks for signing up! Please check your email to complete your registration.']);
    }


        public function update(User $user,Request $request)
        {   
     	 
         if($user->update($request->all()))
        {
       	  return $user;
         }

       }

    public function destroy($id)
    {
    	$user=User::find($id);
    	if($user->delete())
    		 return "success";
    }

      
    
    public function verifyUser($verification_code)
    {
        $check = DB::table('user_verifications')->where('token',$verification_code)->first();

        if(!is_null($check)){
            $user = User::find($check->user_id);

            if($user->is_verified == 1){
                return response()->json([
                    'success'=> true,
                    'message'=> 'Account already verified..'
                ]);
            }

            $user->update(['is_verified' => 1]);
            DB::table('user_verifications')->where('token',$verification_code)->delete();
          //  $message="verified";
            //return view('email/verify')->withMessage($message);

            return response()->json([
                 'success'=> true,
                 'message'=> 'You have successfully verified your email address.'
             ]);
        }

        return response()->json(['success'=> false, 'error'=> "Verification code is invalid."]);

    }


     public function login(Request $request)
    {
        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];

        $input = $request->only('email', 'password');

        $validator = Validator::make($input, $rules);

        if($validator->fails()) {
            $error = $validator->messages()->toJson();
            return response()->json(['success'=> false, 'error'=> $error]);
        }

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
            'is_verified' => 1
        ];

        try {
            // attempt to verify the credentials and create a token for the user
            if (! $token = JWTAuth::attempt($credentials)) {
                return response()->json(['success' => false, 'error' => 'Invalid Credentials. Please make sure you entered the right information and you have verified your email address.'], 401);
            }
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'could_not_create_token'], 500);
        }

        // all good so return the token
        return response()->json(['success' => true, 'data'=> [ 'token' => $token ]]);
    }

     /**
     * Log out
     * Invalidate the token, so user cannot use it anymore
     * They have to relogin to get a new token
     *
     * @param Request $request
     */
    public function logout(Request $request) 
    {
        $this->validate($request, ['token' => 'required']);

        try {
            JWTAuth::invalidate($request->input('token'));
            return response()->json(['success' => true]);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(['success' => false, 'error' => 'Failed to logout, please try again.'], 500);
        }
    }
      /**
     * API Recover Password
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function recover(Request $request)
    {
        $user = User::where('email', $request->email)->first();
       //return $user;
        if (!$user) {
            $error_message = "Your email address was not found.";
            return response()->json(['success' => false, 'error' => ['email'=> $error_message]], 401);
        }

        try {
            Password::sendResetLink($request->only('email'), function (Message $message) {
                $message->subject('Your Password Reset Link');
            });

        } catch (\Exception $e) {
            //Return with error
            $error_message = $e->getMessage();
            return response()->json(['success' => false, 'error' => $error_message], 401);
        }

        return response()->json([
            'success' => true, 'data'=> ['msg'=> 'A reset email has been sent! Please check your email.']
        ]);
    }
    public function token(Request $request)

 {
    // $token = JWTAuth::getToken();
    // if(!$token){
    //     throw new BadRequestHtttpException('Token not provided');
    // }
    $token=$request->token;
    try{
        $token = JWTAuth::refresh($token);
    }catch(TokenInvalidException $e){
        throw new AccessDeniedHttpException('The token is invalid');
    }
    return $token;
    // return $this->response->withArray(['token'=>$token]);
  }
       public function assignRoleToUser(Request $request)
    {
        $user = User::where('email', $request->email)->first();
        if ($role = Role::select('title')->where('title', $request->role)->first()) {
            $user->roles()->detach();
            $user->roles()->attach(Role::where('title', $request->role)->first());
               return "user role Changed to" . $request->role. "Successfully"; 
           
        } else {
            return "User Role titled " . $request->role . " did not found any matching roles";
        }
}   }







    






