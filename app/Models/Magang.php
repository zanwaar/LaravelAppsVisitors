<?php

namespace App\Models;

use Carbon\Carbon;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
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
    protected $fillable = [
        'bagian_id',
        'nama',
        'sekolah',
        'tglmulai',
        'tglselesai',
        'status',
        'pembimbing',
        'foto',
    ];
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
    protected $appends = [
        'foto_url',
    ];
    public function getFotoUrlAttribute()
    {
        if ($this->foto && Storage::disk('avatars')->exists($this->foto)) {
            return Storage::disk('avatars')->url($this->foto);
        }

        return asset('noimage.png');
    }
}
