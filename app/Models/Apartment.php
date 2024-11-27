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
        'latitude',
        'longitude',
        'rooms_available',
        'room_rate',
        'apartment_images',
        'description',
        'status',
    ];

    public function landlord()
    {
        return $this->belongsTo(Landlord::class);
    }

    protected $casts = [
        'apartment_images' => 'array',
    ];

    // Accessor to get the thumbnail image
    public function getThumbnailAttribute()
    {
        $images = $this->apartment_images; // Already an array
        return $images[0] ?? null;
    }

}
