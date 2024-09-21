<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $table = 'apartments';


    protected $primaryKey = 'id';

    protected $fillable = [
        'landlord_id',
        'landlord_name',
        'address',
        'contact_no',
        'facebook',
        'email',
        'apartment_name',
        'location',
        'rooms_available',
        'room_rate',
        'apartment_image',
        'description',
        'status',
    ];

    public function landlord()
    {
        return $this->belongsTo(Landlord::class);
    }
}
