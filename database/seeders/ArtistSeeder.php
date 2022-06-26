<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Faker\Generator;
use App\Models\Artist;

class ArtistSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        for($i = 0; $i < 100; $i++) {
            $artistObj = new Artist;
            $artistObj->name = strtoupper($faker->name);
            $artistObj->save();
            $artistObj->link = route("artist.show", ["id" => $artistObj->id]);
            $artistObj->share = route("artist.show", ["id" => $artistObj->id])."?utm_source=deezer&utm_content=artist-{$artistObj->id}&utm_term=0_1656207095&utm_medium=web";
            $artistObj->picture = $faker->imageUrl(1920, 1920, "artist");
            $artistObj->picture_small = $faker->imageUrl(56, 56, "artist");
            $artistObj->picture_medium = $faker->imageUrl(250, 250, "artist");
            $artistObj->picture_big = $faker->imageUrl(500, 500, "artist");
            $artistObj->picture_xl = $faker->imageUrl(1000, 1000, "artist");
            $artistObj->nb_album = $faker->randomNumber(2);
            $artistObj->nb_fan = $faker->randomNumber();
            $artistObj->tracklist = route("artist.trackList", ["id" => $artistObj->id]);
            $artistObj->save();
        }
    }
}
