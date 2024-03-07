<?php

namespace App\Http\Controllers;

use App\Models\UserDetail;
use Illuminate\Http\Request;

class ProfileController extends Controller {
    public function index(){
        return view("account.profile", [
            "userDetail" => auth()->user()->userDetail
        ]);
    }

    public function update(){

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
