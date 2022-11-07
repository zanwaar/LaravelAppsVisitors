<?php

namespace App\Models;

use Carbon\Carbon;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Workingpermit extends Model
{
    use HasFactory;
    use Uuid;
    // use LogsActivity;

    /**
     * The "type" of the auto-incrementing ID.
     *
     * @var string
     */
    protected $keyType = 'string';

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;
    protected $guarded = [];
    protected $casts = [
        'tglawal' => 'datetime',
        'tglakhir' => 'datetime',
    ];
    protected static $logName = 'WorkingPemit';
    protected static $logFillable = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return  Auth::user()->name . "{$eventName} Working Permit";
    }
    public function personil()
    {
        return $this->hasMany(Personil::class);
    }
    public function getTglawalAttribute($value)
    {
        return Carbon::parse($value)->toFormattedDate();
    }
    public function getTglakhirAttribute($akhir)
    {
        return Carbon::parse($akhir)->toFormattedDate();
    }
}
