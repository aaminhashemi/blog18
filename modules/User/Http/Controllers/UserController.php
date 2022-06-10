<?php


namespace User\Http\Controllers;


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
        $users=$this->repository->allUsers();
        return response()->json([
            'status' => 200,
            'users'=>$users
        ]);
    }
    public function find(User $user)
    {
        return response()->json(['status'=>200,'user'=>$user]);
    }

    public function update(User $user)
    {

        //return response()->json(['status'=>200,'user'=>$user]);
    }

    public function upload()
    {
        return response()->json(['status'=>200,'message'=>'hi']);
    }
}
