<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function show()
    {
        $setting = Setting::first();

        return inertia('Setting/Form', [
            'setting' => $setting
        ]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'midtrans_server_key' => 'required|string',
            'midtrans_client_key' => 'required|string',
            'midtrans_merchant_id' => 'required|string',
            'site_name' => 'required|string',
            'ticket_price' => 'required|numeric',
            'is_production' => 'required|bool',
            'is_open_order' => 'required|in:0,1',
            'term_url' => 'required|url'
        ]);

        $setting = Setting::first();

        $setting->update([
            'midtrans_server_key' => $request->midtrans_server_key,
            'midtrans_client_key' => $request->midtrans_client_key,
            'midtrans_merchant_id' => $request->midtrans_merchant_id,
            'site_name' => $request->site_name,
            'ticket_price' => $request->ticket_price,
            'is_production' => $request->is_production ? 1 : 0,
            'is_open_order' => $request->is_open_order,
            'term_url' => $request->term_url,
        ]);

        return redirect()->route('setting.show')
            ->with('message', ['type' => 'success', 'message' => 'The data has beed saved']);
    }
}
