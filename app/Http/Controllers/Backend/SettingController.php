<?php

namespace App\Http\Controllers\Backend;

use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index () {
    	return view('backend.setting', Setting::getSettings());
    }
    public function store (Request $request) {
    	Setting::where('key', '!=', NULL)->delete();
    	foreach ($request->except('_token') as $key => $value) {//except() - получение всего кроме _token
    			$setting = new Setting;
    			$setting->key = $key;
    			$setting->value = $request->$key;
    			$setting->save();
    	}
    	return redirect()->route('admin.setting.index');
    }
}
