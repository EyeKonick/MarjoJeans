<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class ApartmentsTableSeeder extends Seeder
{
    /**
     * Seed the apartments table.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Array of landlord choices
        $landlords = [
            ['id' => 1, 'name' => 'landlord'],
            ['id' => 3, 'name' => 'test'],
            ['id' => 4, 'name' => 'Landlord1'],
        ];

        for ($i = 0; $i < 15; $i++) {
            // Pick a random landlord from the list
            $randomLandlord = $faker->randomElement($landlords);

            DB::table('apartments')->insert([
                'landlord_id' => $randomLandlord['id'],
                'landlord_name' => $randomLandlord['name'], // Use the corresponding name
                'address' => $faker->address,
                'contact_no' => $faker->phoneNumber,
                'facebook' => $faker->url,
                'email' => $faker->unique()->safeEmail,
                'apartment_name' => $faker->word . ' Apartment',
                'location' => $faker->city,
                'rooms_available' => $faker->numberBetween(1, 5),
                'room_rate' => $faker->randomFloat(2, 100, 2000),
                'apartment_image' => $faker->imageUrl(),
                'description' => $faker->sentence,
                'status' => $faker->randomElement(['pending', 'approved']),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
