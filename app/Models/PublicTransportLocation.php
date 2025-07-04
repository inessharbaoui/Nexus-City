<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PublicTransportLocation extends Model
{
    protected $table = 'public_transport_locations';

    protected $fillable = [
        'public_transport_id', 'sequence', 'location_name', 'fee', 'online_payment', 'latitude', 'longitude', 'arrival_time'
    ];
}
