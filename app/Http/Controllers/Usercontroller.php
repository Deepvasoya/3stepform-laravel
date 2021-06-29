<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class Usercontroller extends Controller
{
    public function profile(Request $request)
    {
        $userdata = User::find($request->id);
        $userdata->name = $request->name;
        $userdata->email = $request->email;
        $userdata->address = $request->address;
        $userdata->Technologies = $request->Technologies;
        $userdata->experience = $request->experience;
        $userdata->companies = $request->companies;
        $userdata->save();
        return response()->json(['success' => "Successfully! Profile has been Updated."]);
    }
}
