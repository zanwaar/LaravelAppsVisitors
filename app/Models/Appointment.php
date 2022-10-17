<?php

namespace App\Models;

use Carbon\Carbon;
use GoldSpecDigital\LaravelEloquentUUID\Database\Eloquent\Uuid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;
    use Uuid;

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
    const STATUS_SCHEDULED = 'SCHEDULED';
    const STATUS_CLOSED = 'CLOSED';

    protected $guarded = [];

    protected $casts = [
    	'date' => 'datetime',
    	'time' => 'datetime',
        'members' => 'array',
    ];

    public function client()  
    {
    	return $this->belongsTo(Client::class);
    }

    public function getStatusBadgeAttribute()
    {
    	$badges = [
    		$this::STATUS_SCHEDULED => 'primary',
    		$this::STATUS_CLOSED => 'success',
    	];

    	return $badges[$this->status];
    }

    public function getDateAttribute($value)
    {
        return Carbon::parse($value)->toFormattedDate();
    }

    public function getTimeAttribute($value)
    {
        return Carbon::parse($value)->toFormattedTime();
    }
}
