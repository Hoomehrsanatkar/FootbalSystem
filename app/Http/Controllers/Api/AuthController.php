<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Role;
use App\Models\RoleUser;

class AuthController extends Controller
{
    public function register(Request $request) {

        // VALIDATE DATA
        $validate_data = Validator::make($request->all(), [
            'name'=> 'required|string|min:5|max:50',
            'email'=> 'required|string|min:5|max:50',
            'password'=> 'required|min:5|max:50',
        ], [
            'name'=> 'فیلد نام کاربری الزامی می‌باشد',
            'email'=> 'فیلد ایمیل الزامی می‌باشد',
            'password'=> 'فیلد رمز عبور الزامی می‌باشد',
        ]);

        if($validate_data->fails()) {
            $all_errors = [];
            foreach($validate_data->errors()->messages() as $error) {
                $all_errors[] = $error;
            }

            return response()-> json([
                'data'=> [
                    'error'=> $all_errors
                ]
            ], 401);
        }

        // CREATE USER IN DATABASE AND CREATE API_TOKEN FOR USER
        $token = Str::random(100);

        $res = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'api_token'=>$token,
        ]);

        // CREATE RELATION FOR USER AND ROLE
        RoleUser::create([
            'user_id'=> $res->id,
            'role_id'=> 1
        ]);

        return response()->json([
            'message'=> 'user registered'
        ]);
    }

    public function login(Request $request) {

        // VALIDATE DATA
        $validate_data = Validator::make($request->all(), [
            'email'=> 'required|string|min:5|max:50|exists:users',
            'password'=> 'required|min:5|max:50',
        ], [
            'email'=> 'فیلد ایمیل الزامی می‌باشد',
            'password'=> 'فیلد رمز عبور الزامی می‌باشد',
        ]);

        if($validate_data->fails()) {
            $all_errors = [];

            foreach($validate_data->errors()->messages() as $error) {
                $all_errors[] = $error;
            }

            return response()-> json([
                'data'=> [
                    'error'=>$all_errors
                ]
            ], 401);
        }

        // FILTER REQUEST AND GIVE ONLY PASSWORD , EMAIL FOR AUTHORIZITION
        $req = $request->only('email', 'password');

        if(!auth()->attempt($req)) {
            return response()->json([
                'data'=> [
                    'error'=> 'اطلاعات فرستاده شده در سایت ثبت نمی‌باشد. رمز و ایمل خود را درست وارد نمایید'
                ]
            ], 401);
        }

        // CREAETE AND PUT NEW TOKEN FOR USER
        $token = Str::random(100);
        auth()->user()->forceFill([
            'api_token'=> hash('sha256', $token),
        ])->save();

        // GIVE ROLE'S USER ON DATABASE
        $user = User::find(auth()->user()->id);
        $role = $user->roles()->pluck('role')->first();

        return response()->json([
            'data'=> [
                'user_id'=> $user->id,
                'token'=> $token,
                'role'=> $role
            ]
        ]);
    }
}
