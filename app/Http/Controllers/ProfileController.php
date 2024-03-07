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
            "profpic_path" => "file|image|max:4096"
        ]);

        if($request->file("profpic_path")){
            if($request->oldImage){
                Storage::delete($request->oldImage);
            }
            $validatedData["profpic_path"] = $request->file("profpic_path")->store("post-images");
        }
        else {
            $validatedData["profpic_path"] = $userDetail->profpic_path;
        }

        UserDetail::where("user_id", auth()->user()->id)->update($validatedData);

        return redirect("/profile")->with("successUpdateProfile", "Your profile successfully updated!");
    }

    // public function create(){
    //     //
    // }

    // public function store(Request $request){
    //     //
    // }

    // public function show(UserDetail $userDetail){
    //     //
    // }

    // public function edit(UserDetail $userDetail){
    //     //
    // }

    // public function update(Request $request, UserDetail $userDetail){
    //     //
    // }

    // public function destroy(UserDetail $userDetail){
    //     //
    // }
}
