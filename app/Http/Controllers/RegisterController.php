<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index(){
        return view("account.register");
    }

    public function store(Request $request){
        $lastId = User::latest()->get()->first();

        $validatedData = $request->validate([
            "name" => "required",
            "email" => "required|email:dns",
            "password" => "required",
            "dob" => "required|date",
            "address" => "required",
            "phone" => "required|min:11|max:14",
            "username" => "required"
        ]);
        $validatedData["password"] = bcrypt($request["password"]);

        $existing = UserDetail::where("username", $validatedData["username"])->exists();
        if($existing){
            $validatedData["username"] = $validatedData["username"] . "-" . round(microtime(true) * 1000);
        }

        $userData = [
            "email" => $validatedData["email"],
            "password" => $validatedData["password"],
            "role_id" => 1
        ];

        $newUser = User::create($userData);

        $userDetailData = [
            "real_name" => $validatedData["name"],
            "dob" => $validatedData["dob"],
            "address" => $validatedData["address"],
            "phone" => $validatedData["phone"],
            "user_id" => $newUser->id,
            "username" => $validatedData["username"]
        ];

        UserDetail::create($userDetailData);

        return redirect("/login")->with("successCreateAccount", "Your new account has been created!");
    }
}
