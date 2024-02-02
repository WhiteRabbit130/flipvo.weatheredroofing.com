<?php

namespace App\Http\Controllers;

use App\Models\Addresses;
use App\Models\ShortBios;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Log;

class UserController extends Controller
{
    /* View of users page */
    public function index(Request $request)
    {
//        $users = User::select('*')->with('address')->with('bio')->get();
//        return view('user.index', compact('users'));
    }

    /*
     * API function for create user
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     * */
    public function store(Request $request)
    {
        $request->validate([
            'first_name' => "required|string",
            'last_name' => "required|string",
            'email' => "required|string|email|unique:users,email",
            'phone' => "required|string",
            'password' => "required|string",
        ]);

        $user = User::create([
            'name' => $request->first_name . ' ' . $request->last_name,
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'type' => $request->type ?? 'regular',
            'phone' => $request->phone,
            'password' => md5($request->password),
        ]);

        if (!$user) {
            return response()->json([
                'status_code' => 501,
                'type' => 'error',
                'message' => "Sorry! Operation couldn't perform, try again!",
            ], 501);
        }

        // todo - addresses
//        if ($request->address) {
//            $address = Addresses::create([
//                'user_id' => $user->id,
//                'address' => $request->address,
//            ]);
//        }
//
        return view('admin.users.index');
    }

    public function update(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'id' => 'required',
//            'first_name' => "required",
//            'last_name' => "required",
//            'type' => "required",
//            'email' => "required",
//            'phone_number' => "required"
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json([
//                'status_code' => 400,
//                'type' => 'error',
//                'message' => $validator->messages()->toArray(),
//            ], 400);
//        }

        // todo - this needs to only by allowed by admin
        //  - update the user info

        $user = User::where('id', $request->id)->first();
        if (!$user) {
            return response()->json([
                'status_code' => 404,
                'type' => 'error',
                'message' => 'User not found or maybe deleted!'
            ], 404);
        }

        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->name = $request->first_name . " " . $request->last_name;
        $user->type = $request->type;

        /* Update password if it has been changed */
        if ($request->password) {
            $user->password = md5($request->password);
        }

        if ($request->phone_number) {
            $user->phone_number = $request->phone_number;
        }

        $user->save();

        return response()->json([
            'status_code' => 200,
            'type' => 'success',
            'message' => 'Record updated successfully',
            'data' => $user,
        ]);
    }

    /*
     * Delete User
     * */
    public function destroy($id)
    {
        $auth = Auth::user();
        // todo - this needs to only by allowed by admin

        if ($auth->type !== 'admin') {
            return response()->json([
                'status_code' => 401,
                'type' => 'error',
                'message' => 'You are not authorized to perform this action.',
            ], 401);
        }

        $user = User::find($id);
        if (!$user) {
            return response()->json([
                'status_code' => 404,
                'type' => 'error',
                'message' => "Sorry! Record not found.",
            ], 404);
        }

        $user->delete();
        return response()->json([
            'status_code' => 200,
            'type' => 'success',
            'message' => 'Great! Record deleted successfully.',
        ], 200);
    }

    /* API function for get all users */
}
