<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller {
    public function index(){
        return view("account.profile", [
            "userDetail" => auth()->user()->userDetail
        ]);
    }

    public function update(Request $request, UserDetail $userDetail){
        $validatedData = $request->validate([
            "real_name" => "required",
            "dob" => "required|date",
            "address" => "required",
            "phone" => "required|min:11|max:14",
            "username" => "required",
            "profpic_path" => "file|image|max:4096"
        ]);

        if($request->file("profpic_path")){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData["profpic_path"] = $request->file("profpic_path")->store("post-images");
        }
        else {
            $validatedData["profpic_path"] = auth()->user()->userDetail->profpic_path;
        }

        if(UserDetail::where("username", $validatedData["username"])->exists() && $userDetail->real_name == $validatedData["real_name"]){
            $validatedData["username"] = $validatedData["username"] . "-" . round(microtime(true) * 1000);
        }

        UserDetail::where("user_id", auth()->user()->id)->update($validatedData);

        return redirect(route("profile"))->with("successUpdateProfile", "Your profile successfully updated!");
    }

    // public function destroy(UserDetail $userDetail){
    //     //
    // }
}
