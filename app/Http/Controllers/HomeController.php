<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $id = Auth::user()->id;
        $authUser = User::where('id', $id)->first();
        return view('home', compact('authUser'));
    }

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

    public function profilephoto(Request $request)
    {
        $path = 'Profile/';
        $file = $request->file('user_image');
        $new_name = 'UIMG_' . date('Ymd') . uniqid() . '.jpg';
        $upload = $file->move(public_path($path), $new_name);

        if (!$upload) {
            return response()->json(['status' => 0, 'msg' => 'Something went wrong, upload new picture failed.']);
        } else {
            $oldPicture = User::find(Auth::user()->id)->getAttributes()['photo'];
            if ($oldPicture != '') {
                if (\File::exists(public_path($path . $oldPicture))) {
                    \File::delete(public_path($path . $oldPicture));
                }
            }
            $update = User::find(Auth::user()->id)->update(['photo' => $new_name]);

            if (!$upload) {
                return response()->json(['status' => 0, 'msg' => 'Something went wrong, updating picture in db failed.']);
            } else {
                return response()->json(['status' => 1, 'msg' => 'Your profile picture has been updated successfully']);
            }
        }
    }
}
