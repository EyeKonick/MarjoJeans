<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    // Specify the table if it's not the plural form of the model name
    protected $table = 'apartments';

    // Define which attributes are mass assignable
    protected $primaryKey = 'id';

    protected $fillable = [
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
        'status', // Make sure this field exists in your database migration
    ];

    public function landlord()
    {
        return $this->belongsTo(Landlord::class);
    }
}
