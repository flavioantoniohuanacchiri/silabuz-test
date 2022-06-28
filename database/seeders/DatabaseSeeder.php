<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();

        DB::table("track")->truncate();
        DB::table("album")->truncate();
        DB::table("artist")->truncate();
       
        $this->call(ArtistSeeder::class);
        $this->call(AlbumSeeder::class);
        $this->call(TrackSeeder::class);

        Schema::enableForeignKeyConstraints();

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
