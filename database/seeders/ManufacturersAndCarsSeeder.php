<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ManufacturersAndCarsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Insert data into Manufacturers table
        DB::table('manufacturers')->insert([
            [
                'id' => 1,
                'title' => 'Acura',
                'description' => 'Acura is the luxury and performance division of Japanese automaker Honda, based primarily in North America.',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'id' => 2,
                'title' => 'Audi',
                'description' => 'Audi AG is a German automotive manufacturer of luxury vehicles headquartered in Ingolstadt, Bavaria, Germany.',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'id' => 3,
                'title' => 'BMW',
                'description' => 'Bayerische Motoren Werke AG, abbreviated as BMW, is a German multinational manufacturer of luxury vehicles and motorcycles headquartered in Munich, Bavaria, Germany.',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'id' => 4,
                'title' => 'Kia',
                'description' => 'Kia Corporation, commonly known as Kia, is a South Korean multinational automobile manufacturer headquartered in Seoul, South Korea.',
                'created_at' => date("Y-m-d H:i:s")
            ]
        ]);


        // Insert data into Cars table
        DB::table('cars')->insert([
            [
                'manufacturers_id' => 1,
                'title' => 'Acura TL',
                'description' => 'The Acura TL is an executive car that was manufactured by Acura, the luxury division of Honda.',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'manufacturers_id' => 1,
                'title' => 'Acura TLX',
                'description' => 'The Acura TLX is a four-door entry-level luxury sedan sold by Acura, a luxury division of Honda, since 2014.',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'manufacturers_id' => 2,
                'title' => 'A3',
                'description' => 'With its sleek design, the A3 features the iconic body lines and silhouette of an Audi Sedan.',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'manufacturers_id' => 2,
                'title' => 'Q3',
                'description' => 'The Audi Q3 is a subcompact luxury crossover SUV made by Audi. The Q3 has a transverse-mounted front engine, and entered production in 2011.',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'manufacturers_id' => 3,
                'title' => 'M4',
                'description' => 'The BMW M4 Coupé is a puristic sports coupé with outstanding driving characteristics.',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'manufacturers_id' => 4,
                'title' => 'Carnival',
                'description' => 'The Carnival MPV EX Trim combines intuitive technology features with multi-purpose capability.',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'manufacturers_id' => 4,
                'title' => 'Sportage',
                'description' => 'The Kia Sportage is a lineup of sport utility vehicles manufactured by the South Korean manufacturer Kia since 1993 through five generations,.',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'manufacturers_id' => 4,
                'title' => 'Rio',
                'description' => 'The Kia Rio is a subcompact car manufactured by Kia since November 1999 and now in its fourth generation.',
                'created_at' => date("Y-m-d H:i:s")
            ],[
                'manufacturers_id' => 4,
                'title' => 'Telluride',
                'description' => 'The Kia Telluride is a mid-size crossover SUV with three-row seating manufactured and marketed by Kia since 2019.',
                'created_at' => date("Y-m-d H:i:s")
            ]
        ]);
    }
}
