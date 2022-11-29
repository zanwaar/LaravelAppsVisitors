<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Spatie\Activitylog\Traits\LogsActivity;

class Logtamu extends Model
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
    protected static $logName = 'LogTamu';
    protected static $logFillable = true;
    protected $appends = [
        'foto_url',
    ];


    public function getFotoUrlAttribute()
    {
        if ($this->foto && Storage::disk('upload')->exists($this->foto)) {
            return Storage::disk('upload')->url($this->foto);
        }

        return asset('noimage.png');
    }
    public function getDescriptionForEvent(string $eventName): string
    {
        return  Auth::user()->name . " Melakukan {$eventName} Log Tamu";
    }
    public function tamu()
    {
        return $this->belongsTo(Tamu::class);
    }
    public function bagian()
    {
        return $this->belongsTo(Bagian::class);
    }
}
