<?php

namespace App\Models;

use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Spatie\Activitylog\Traits\LogsActivity;

class Barang extends Model
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
    const STATUS_TRUE = 'Belum Diambil';
    const STATUS_FALSE = 'Sudah Diambil';
    protected $guarded = [];
    protected static $logName = 'Barang';
    protected static $logFillable = true;

    public function getDescriptionForEvent(string $eventName): string
    {
        return  Auth::user()->name . " Melakukan {$eventName} Pada Model Barang / Surat";
    }
    public function bagian()
    {
        return $this->belongsTo(Bagian::class);
    }
    public function getStatusBadgeAttribute()
    {
        $badges = [
            $this::STATUS_TRUE => 'warning',
            $this::STATUS_FALSE => 'primary',
        ];

        return $badges[$this->status];
    }
    public function getStatusAttribute($value)
    {
        if ($value === 1) {
            return 'Sudah Diambil';
        } else {
            return 'Belum Diambil';
        }
    }
}
