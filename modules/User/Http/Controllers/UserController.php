<?php


namespace User\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use User\Models\User;
use User\Repositories\UserRepository;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public $repository;

    public function __construct(UserRepository $userRepository)
    {
        $this->repository = $userRepository;

    }

    public function index()
    {
        $users = $this->repository->allUsers();
        return response()->json([
            'status' => 200,
            'users' => $users
        ]);
    }

    public function find(User $user)
    {
        return response()->json(['status' => 200, 'user' => $user]);
    }

    public function upload()
    {
        return response()->json(['status' => 200, 'message' => 'hi']);
    }

    public function addRole(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        $user->assignRole($request->role);
        return response()->json([
            'status' => 200,
        ]);

    }

    public function save(Request $request)
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
            return response()->json([
                'status' => 200,
                'message' => 'ثبت کاربر با موفقیت انجام شد.'
            ]);
        } else {
            return response()->json([
                'status' => 403,
                'message' => 'خطا در داده های ارسالی',
                'validation_errors' => $validator->messages()
            ]);
        }
    }
    public function update(Request $request,$user)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|min:3|max:20',
            'last_name' => 'required|string|min:3|max:20',
            'email' => 'required|email|unique:users,id,email|min:5|max:50',
            'password' => 'required|string|min:6|max:10',
            'mobile' => 'required|string|unique:users,id,mobile|min:11|max:11',
        ]);
        if ($validator->passes()) {
            $user = User::where('id', $user)->first();
            $user->update([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'mobile' => $request->mobile,
                'password' => Hash::make($request->password)
            ]);
            return response()->json([
                'status' => 200,
                'message' => 'ثبت کاربر با موفقیت انجام شد.'
            ]);
        } else {
            return response()->json([
                'status' => 403,
                'message' => 'خطا در داده های ارسالی',
                'validation_errors' => $validator->messages()
            ]);
        }
    }

}
