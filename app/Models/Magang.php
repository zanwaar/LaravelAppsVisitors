<?php

namespace App\Models;

use Carbon\Carbon;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Magang extends Model
{
    use HasFactory;
    use Uuid;
    use LogsActivity;

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
        'tglmulai' => 'datetime',
        'tglselesai' => 'datetime',
    ];
    protected static $logName = 'Magang';
    protected static $logFillable = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return  Auth::user()->name . " Melakukan {$eventName} Log Tamu";
    }
    public function bagian()
    {
        return $this->belongsTo(Bagian::class);
    }
    public function getTglmulaiAttribute($mulai)
    {
        return Carbon::parse($mulai)->toFormattedDate();
    }
    public function getTglselesaiAttribute($selesai)
    {
        return Carbon::parse($selesai)->toFormattedDate();
    }
}
