<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users= User::orderBy('id','desc')->paginate(5);

        return response()->json([
            'users' => $users
        ]);
    }

    public function deleteAll(Request $request){
        foreach ($request->data as $id) {
            $user= User::find($id);
            $user->delete();
        }
    }

    public function activeAll(Request $request){
        foreach ($request->data as $id) {
            $user =User::find($id);
            $user->status = $request->status;

            $user->update();
        }
    }

    public function roleAll(Request $request){
        foreach ($request->data as $id) {
            $user =User::find($id);
            $user->user_role = $request->role;

            $user->update();
        }
    }
}
