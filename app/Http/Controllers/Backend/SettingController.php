<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\Services\FileManagementServices;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;

class SettingController extends Controller
{
    public function settingsView()
    {
        return view('backend.core.settings');
    }

    public function settingsUpdate(Request $request)
    {
        $request_data = $request->all();


        if ($request->hasFile('site_logo')) {
            $file                      = $request->file('site_logo');
            $request_data['site_logo'] = (new FileManagementServices())->updateImage($file, get_setting('site_logo'));
        } else {
            $request_data['site_logo'] = get_setting('site_logo');
        }
        if ($request->hasFile('fav_icon')) {
            $file                     = $request->file('fav_icon');
            $request_data['fav_icon'] = (new FileManagementServices())->updateImage($file, get_setting('fav_icon'));
        } else {
            $request_data['fav_icon'] = get_setting('fav_icon');
        }


        try {
            array_walk($request_data, function ($value, $key) {
                if ($key != '_token') {
                    $setting_data = Setting::query()->where(['key' => $key])->first();
                    if ($setting_data) {
                        $setting_data->update(['value' => $value]);
                    } else {
                        Setting::query()->create([
                            'key'   => $key,
                            'value' => $value
                        ]);
                    }

                    Cache::forget($key);
                }
            });
            Session::flash('toast', [
                'type' => 'success',
                'msg'  => __('Settings Updated!'),
            ]);
        } catch (\Exception $e) {
            Session::flash('toast', [
                'type' => 'danger',
                'msg'  => __('Failed To Update Settings!'),
            ]);
        }
        return redirect()->route('admin.settings.view');
    }
}
