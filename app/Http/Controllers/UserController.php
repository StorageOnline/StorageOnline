<?php

namespace App\Http\Controllers;

use App\Model\Role;
use App\Model\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->relationRole;
            $user->relationCompany;
        }
        $data['users'] = $users;
        dump($data);
        return view('user', $data);
    }
}
