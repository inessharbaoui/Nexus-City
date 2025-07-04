<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicTransportLocationReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'location_id',
        'report_reason',
    ];

    public function location()
    {
        return $this->belongsTo(PublicTransportLocation::class);
    }
}
