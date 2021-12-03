<?php


namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:read_settings')->only(['index', 'socialLinks', 'socialLogin']);

    }// end of __construct

    public function general()
    {
        return view('admin.settings.general');

    }// end of index

    public function socialLinks()
    {
        return view('admin.settings.social_links');

    }// end of socialLink

    public function socialLogin()
    {
        return view('admin.settings.social_login');

    }// end of socialLogin

    public function mobileLinks()
    {
        return view('admin.settings.mobile_links');

    }// end of mobileLinks

    public function store(Request $request)
    {
       // dd($request->all());
        $request->validate([
            'email' => 'sometimes|nullable|email',
        ]);

        $requestData = $request->except(['_token', '_method']);

        if ($request->logo) {
            Storage::disk('local')->delete('public/uploads/' . setting('logo'));
            $request->logo->store('public/uploads');
            $requestData['logo'] = $request->logo->hashName();
        }

        if ($request->fav_icon) {
            Storage::disk('local')->delete('public/uploads/' . setting('fav_icon'));
            $request->fav_icon->store('public/uploads');
            $requestData['fav_icon'] = $request->fav_icon->hashName();
        }

        setting($requestData)->save();

        session()->flash('success', __('site.added_successfully'));
        return redirect()->back();

    }// end of store

}//end of controller


