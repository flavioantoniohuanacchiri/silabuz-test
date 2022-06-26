<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Faker\Generator;
use App\Models\Track;
use App\Models\Album;

class TrackSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for($i = 0; $i < 1000; $i++) {
            $albumId = $faker->numberBetween(1, 200);
            $albumObj = Album::find($albumId);
            
            $trackObj = new Track;
            $trackObj->album_id = $albumId;
            $trackObj->artist_id = !is_null($albumObj)? $albumObj->artist_id : 1;
            $trackObj->title = strtoupper($faker->name);
            $trackObj->title_short = strtoupper($faker->name);
            $trackObj->isrc = $faker->isbn10();
            $trackObj->save();

            $trackObj->link = route("track.show", ["id" => $trackObj->id]);
            $trackObj->share = route("track.show", ["id" => $trackObj->id])."?utm_source=deezer&utm_content=Track-{$trackObj->id}&utm_term=0_1656207095&utm_medium=web";
            $trackObj->duration = $faker->randomNumber(5);
            $trackObj->track_position = $faker->randomNumber(2);
            $trackObj->disk_number = $faker->randomNumber(1);
            $trackObj->rank = $faker->randomNumber(8);
            $trackObj->release_date = $faker->date();
            $trackObj->explicit_content_lyrics = $faker->numberBetween(0, 7);
            $trackObj->explicit_content_cover = $faker->numberBetween(0, 7);
            $trackObj->bpm = $faker->randomFloat(1, 1.5, 999.9);
            $trackObj->gain = $faker->randomFloat(1, -1.5, 999.9);
            $trackObj->save();
        }
    }
}
