<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Helpers\Uploader;
use App\Models\User\Language;
use App\Models\User\UserContact;
use Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function index(Request $request)
    {
        // first, get the language info from db
        $language = Language::where('code', $request->language)->where('user_id', Auth::user()->id)->first();
        // then, get the service section heading info of that language from db
        $information['data'] = UserContact::where('language_id', $language->id)->where('user_id', Auth::user()->id)->first();
        // get all the languages from db
        return view('user.contact', $information);
    }

    public function update(Request $request, $language)
    {
        $lang = Language::where('code', $language)->where('user_id', Auth::user()->id)->first();
        $data = UserContact::where([
            ['user_id', Auth::user()->id],
            ['language_id', $lang->id]
        ])->first();
        if (is_null($data)) {
            $data = new UserContact;
        }

        $rules = [
            'contact_form_title' => 'nullable|max:255',
            'contact_form_subtitle' => 'nullable|max:255',
            'contact_addresses' => 'nullable',
            'contact_numbers' => 'nullable',
            'contact_mails' => 'nullable|max:255',
            'latitude' => 'nullable|max:255',
            'longitude' => 'nullable|max:255',
            'map_zoom' => 'nullable|max:255',
        ];
        if (
            empty($data->contact_form_image) &&
            !$request->hasFile('contact_form_image')
        ) {
            $rules['contact_form_image'] = 'required|mimes:jpeg,jpg,png';
        }
        $messages = [
            'contact_form_image.required' => 'The contact image field is required'
        ];
        $validator = Validator::make($request->all(), $rules, $messages);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        $image = isset($data) ? $data->contact_form_image : null;
        $request['image_name'] = $image;
        if ($request->hasFile('contact_form_image')) {
            $request['image_name'] = Uploader::update_picture('assets/front/img/user/', $request->file('contact_form_image'), $image);
        }
        $data->contact_form_image = $request->image_name;
        $data->contact_form_title = $request->contact_form_title;
        $data->contact_form_subtitle = $request->contact_form_subtitle;
        $data->contact_addresses = clean($request->contact_addresses);
        $data->contact_numbers = $request->contact_numbers;
        $data->contact_mails = $request->contact_mails;
        $data->language_id = $lang->id;
        $data->user_id = Auth::user()->id;
        $data->latitude = $request->latitude;
        $data->longitude = $request->longitude;
        $data->map_zoom = $request->map_zoom ? $request->map_zoom : 0;
        $data->save();
        $request->session()->flash('success', 'Contact section updated successfully!');
        return back();
    }
}
