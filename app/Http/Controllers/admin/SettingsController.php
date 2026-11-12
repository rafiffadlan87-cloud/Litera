<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SettingsSystem;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function index()
    {
        $settings = [
            'max_borrow_days'     => (int) SettingsSystem::get('max_borrow_days', 7),
            'fine_per_day'        => (int) SettingsSystem::get('fine_per_day', 1000),
            'max_extension_days'  => (int) SettingsSystem::get('max_extension_days', 7),
        ];

        return view('admin.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'max_borrow_days'    => ['required', 'integer', 'min:1', 'max:365'],
            'fine_per_day'       => ['required', 'integer', 'min:0', 'max:1000000'],
            'max_extension_days' => ['required', 'integer', 'min:1', 'max:365'],
        ], [
            'max_borrow_days.required'    => 'Durasi peminjaman wajib diisi.',
            'max_borrow_days.min'         => 'Minimal 1 hari.',
            'fine_per_day.required'       => 'Denda per hari wajib diisi.',
            'fine_per_day.min'            => 'Denda tidak boleh negatif.',
            'max_extension_days.required' => 'Durasi perpanjangan wajib diisi.',
            'max_extension_days.min'      => 'Minimal 1 hari.',
        ]);

        foreach ($validated as $key => $value) {
            SettingsSystem::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return back()->with('success', 'Pengaturan sistem berhasil diperbarui!');
    }
}