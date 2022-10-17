<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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
        'site_name',
        'site_title',
        'footer_text',
        'sidebar_collapse',
    ];

    protected $casts = [
        'sidebar_collapse' => 'boolean',
    ];
    // public function getActivitylogOptions(): LogOptions
    // {
    //     return LogOptions::defaults()
    //         ->useLogName('system')
    //         ->setDescriptionForEvent(fn (string $eventName) => "This model has been {$eventName}");
    // }
    // public function user()
    // {
    //     return $this->belongsTo(User::class);
    // }

}
