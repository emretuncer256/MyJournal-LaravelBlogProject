<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ConfigModel as CM;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class ConfigController extends Controller
{
    public function index()
    {
        $data = [
            'config' => CM::findOrFail(1),
        ];
        return view('admin.configs.index', $data);
    }

    public function update(Request $request)
    {
        $request->validate([
            'logo' => 'image|mimes:jpeg,jpg,png|max:4096',
            'favicon' => 'image|mimes:jpeg,jpg,png|max:4096',
        ]);
        $default = CM::findOrFail(1);
        $data = [];
        foreach ($request->post() as $key => $value) {
            if ($key != '_token') {
                $data[$key] = $value;
            }
        }
        if ($request->hasFile('logo')) {
            if (File::exists($default->logo)) {
                File::delete(public_path($default->logo));
            }
            $logoName = Str::random() . "." . "logo" . "." . $request->logo->getClientOriginalExtension();
            $request->logo->move(public_path('uploads\configs\logos'), $logoName);
            $data['logo'] = 'uploads/configs/logos/' . $logoName;
        }
        if ($request->hasFile('favicon')) {
            if (File::exists($default->favicon)) {
                File::delete(public_path($default->favicon));
            }
            $faviconName = Str::random() . "." . "favicon" . "." . $request->favicon->getClientOriginalExtension();
            $request->favicon->move(public_path('uploads\configs\favicons'), $faviconName);
            $data['favicon'] = 'uploads/configs/favicons/' . $faviconName;
        }
        $success = CM::whereId(1)->update($data);
        return $success ? 'success' : 'error';
    }
}
