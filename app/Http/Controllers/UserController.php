<?php

namespace App\Http\Controllers;

use App\Model\Role;
use App\Model\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(User $user)
    {
        $this->middleware('auth');
        $this->model = $user;
    }

    public function index()
    {
        $users = $this->model->paginate(10);
        foreach ($users as $user) {
            $user->relationRole;
            $user->relationCompany;
        }
        $data['users'] = $users;
//        dump($data);
        return view('user', $data);
    }
}
