<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProfileRequest;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function edit()
    {

        //dd(auth()->user()->image_path);

        return view('admin.profile.edit');

    }// end of getChangeData

    public function update(ProfileRequest $request)
    {
        $requestData = $request->validated();
        if ($request->image) {
            if (auth()->user()->hasImage()){
                Storage::disk('local')->delete('public/uploads/users/'.auth()->user()->image);
            }
            $request->image->store('public/uploads/users');
            $requestData['image'] = $request->image->hashName();
        }
        auth()->user()->update($requestData);
        session()->flash('success', __('site.updated_successfully'));
        return redirect()->route('admin.home');

    }// end of postChangeData

}//end of controller
