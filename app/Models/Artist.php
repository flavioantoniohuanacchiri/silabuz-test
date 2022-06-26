<?php

namespace App\Models;

use App\Models\BaseModel;

class Artist extends BaseModel
{
    protected $table = "artist";

    public function albums() {
    	return $this->hasMany("App\Models\Album", "artist_id", "id");
    }
    public function tracksByArtist() {
    	return $this->hasMany("App\Models\Track", "artist_id", "id");
    }
}
