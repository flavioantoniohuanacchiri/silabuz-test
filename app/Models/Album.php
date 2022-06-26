<?php

namespace App\Models;

use App\Models\BaseModel;

class Album extends BaseModel
{
    protected $table = "album";

    public function tracksByAlbum() {
    	return $this->hasMany("App\Models\Track", "album_id", "id");
    }
}
