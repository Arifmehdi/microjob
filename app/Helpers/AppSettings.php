<?php

use App\Models\Setting;
use Illuminate\Support\Facades\Cache;

if (!function_exists('get_setting')) {


    function get_setting($key)
    {
        return Cache::rememberForever($key, function () use ($key) {
            $value = Setting::query()->where(['key' => $key])->first();
            if ($value) {
                return $value->value ?? '';
            }
            return '';
        });
    }
}
