<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SettingsSystem extends Model
{
    use HasFactory;

    protected $table = 'settings_system';
    protected $primaryKey = 'key';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = ['key', 'value'];

    public static function get($key, $default = null)
    {
        $setting = self::find($key);
        return $setting ? $setting->value : $default;
    }
}