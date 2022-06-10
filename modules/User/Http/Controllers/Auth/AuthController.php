<?php


namespace User\Http\Controllers\Auth;


use User\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|min:3|max:20',
            'last_name' => 'required|string|min:3|max:20',
            'email' => 'required|email|unique:users,email|min:5|max:50',
            'password' => 'required|string|min:6|max:10',
            'mobile' => 'required|string|unique:users,mobile|min:11|max:11',
        ]);
        if ($validator->passes()) {
            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => Hash::make($request->password)
            ]);
            $token = $user->createToken($user->email . '_token')->plainTextToken;
            return response()->json([
                'status' => 200,
                'username' => $user->first_name . ' ' . $user->last_name,
                'token' => $token,
                'message' => 'ثبت نام با موفقیت انجام شد.'
            ]);
        } else {
            return response()->json([
                'status' => 403,
                'message' => 'خطا در داده های ارسالی',
                'validation_errors' => $validator->messages()
            ]);
        }
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|min:4|max:255',
            'password' => 'required|string|min:6|max:20'
        ]);

        if ($validator->passes()) {
            if(filter_var( $request->email ,FILTER_VALIDATE_EMAIL )){
                $user = User::where('email', $request->email)->first();
            }else{
                $user = User::where('mobile', $request->email)->first();
            }

            if (!$user || !Hash::check($request->password, $user->password)) {
                return response()->json([
                    'status' => 401,
                    'message' => 'نام کاربری یا کلمه عبور اشتباه است'
                ]);
            } else {
                $token = $user->createToken($user->email . '_token')->plainTextToken;
                return response()->json([
                    'status' => 200,
                    'username' => $user->first_name . ' ' . $user->last_name,
                    'token' => $token,
                    'message' => 'ورود با موفقیت انجام شد.'
                ]);
            }
        } else {
            return response()->json([
                'status' => 403,
                'validation_errors' => $validator->messages()
            ]);
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response()->json([
            'status' => 200,
            'message' => 'شما با موفقیت خارج شدید.'
        ]);
    }
}
