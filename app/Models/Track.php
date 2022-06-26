<?php

namespace App\Models;

use App\Models\BaseModel;

class Track extends BaseModel
{
    protected $table = "track";

    public function album() {
    	return $this->hasOne("App\Models\Album", "id", "album_id");
    }
    public function artist() {
    	return $this->hasOne("App\Models\Artist", "id", "artist_id");
    }
}
