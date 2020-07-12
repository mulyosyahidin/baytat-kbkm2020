<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Social_link;
use App\Models\Slider;
use App\Models\Setting;
use App\User;
use Auth;
use Illuminate\Support\Facades\DB;

class SettingController extends Controller
{
    public function index()
    {
        $params['setting'] = Setting::find(3);

        return view('admin.settings.general')   
            ->with($params);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'icon' => 'nullable|max:1024|mimes:png,ico,jpg,jpeg',
            'logo' => 'nullable|max:2048|mimes:jpg,png,jpeg'
        ]);

        $setting = Setting::findOrFail(3);

        DB::table('settings')
            ->where('key', 'siteName')
            ->update(['content' => $request->name]);

        if ($request->hasFile('logo') && $request->file('logo')->isValid()) {
            if (isset($setting->media[0])) {
                $setting->media[0]->delete();
            }

            $setting->addMediaFromRequest('logo')
                ->toMediaCollection('site_logo');
        }
        
        return redirect()
            ->back()
            ->withSuccess('Pengaturan berhasil diperbarui');
    }

    public function social_links()
    {
        $params['socials'] = Social_link::all();

        return view('admin.settings.socials')
            ->with($params);
    }

    public function store_social_links(Request $request)
    {
        $social = new Social_link;

        $add = $request->link;
        if (is_array($add) && count($add) > 0)
        {
            $insert = [];
            $n = 0;
            foreach ($add as $data) {
                $insert[$n] = $data;

                if ($insert[$n]['title'] == '') {
                    unset($insert[$n]);
                }

                $n++;
            }

            Social_link::insert($insert);

            $flash = 'Data berhasil ditambahkan';
        }

        $update = $request->update;
        if (is_array($update) && count($update) > 0)
        {
            foreach ($update as $id => $new_data)
            {
                $social = Social_link::findOrFail($id);

                $social->title = $new_data['title'];
                $social->link = $new_data['link'];
                $social->fa_icon = $new_data['fa_icon'];
                $social->num_order = $new_data['num_order'];

                $social->save();
            }

            $flash = 'Data berhasil diperbarui';
        }

        $do_delete = $request->do_delete;
        if ($do_delete) {
            $deletes = $request->delete;

            if (is_array($deletes) && count($deletes) > 0)
            {
                foreach ($deletes as $link_id => $del)
                {
                    $link = Social_link::findOrFail($link_id);
                    $link->delete();
                }
            }

            $flash = 'Data berhasil dihapus';
        }

        return redirect()
            ->back()
            ->withSuccess($flash);
    }

    public function sliders()
    {
        $params['sliders'] = Slider::all();

        return view('admin.settings.sliders')
            ->with($params);
    }

    public function profile()
    {
        return view('admin.settings.profile');
    }

    public function store_profile(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'nullable|min:6',
            'picture' => 'nullable|mimes:jpg,jpeg,png|max:5096'
        ]);

        $user = User::findOrFail(Auth::id());

        $user->name = $request->name;
        $user->email = $request->email;

        $password = ($request->password == '') ? Auth::user()->password : bcrypt($request->password);
        $user->password = $password;

        $user->save();

        if ($request->hasFile('picture') && $request->file('picture')->isValid()) {
            if (isset($user->media[0]))
            {
                $user->media[0]->delete();
            }

            $user->addMediaFromRequest('picture')
                ->toMediaCollection('admin_picture');
        }

        return redirect()
            ->back()
            ->withSuccess('Profil berhasil diperbarui');
    }
}
