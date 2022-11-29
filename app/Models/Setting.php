<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\Activitylog\LogOptions;

class Setting extends Model
{
    use HasFactory;
    use LogsActivity;
    protected static $logName = 'Setting';
    protected static $logFillable = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return  Auth::user()->name . " Melakukan {$eventName} Pada Model Settings";
    }

    public $fillable = [
        'site_email',
        'site_logo',
        'site_name',
        'site_title',
        'footer_text',
        'sidebar_collapse',
    ];

    protected $casts = [
        'sidebar_collapse' => 'boolean',
    ];
    protected $appends = [
        'logo_url',
    ];

    public function getLogoUrlAttribute()
    {
        if ($this->site_logo && Storage::disk('images')->exists($this->site_logo)) {
            return Storage::disk('images')->url($this->site_logo);
        }

        return asset('noimage.png');
    }
}
