<?php
// ============================================================
// SettingController
// ============================================================
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
         $settings = Setting::all()->pluck('value', 'key');
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        foreach ($request->settings ?? [] as $key => $value) {
            Setting::setValue($key, $value);
        }

        // Handle logo upload separately
        if ($request->hasFile('settings_logo')) {
            $path = uploadImage('assets/admin/uploads', $request->settings_logo);
            Setting::setValue('logo', $path);
        }
        if ($request->hasFile('settings_favicon')) {
            $path = uploadImage('assets/admin/uploads', $request->settings_favicon);
            Setting::setValue('favicon', $path);
        }

        return back()->with('success', __('admin.saved_successfully'));
    }
}