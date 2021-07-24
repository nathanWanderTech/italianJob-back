<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterUserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param RegisterUserRequest $registerUserRequest
     * @return User
     */
    public function store(RegisterUserRequest $registerUserRequest): User
    {
        $input = $registerUserRequest->only(['name', 'email', 'password']);
        $input['password'] = Hash::make($input['password']);

        return User::create($input);
    }
}
