<?php namespace App\Formats;

use App\Formats\ArtistFormat;
use App\Formats\AlbumFormat;

class TrackFormat {

    public function setForApi($entity) {
        @$entity->readable = ($entity->readable == 1)? true : false;
        @$entity->explicit_lyrics = ($entity->explicit_lyrics == 1)? true : false;
        @$entity->type = "track";
        //@$entity->album = new \stdClass;
        if (!isset($entity->artist) || is_null($entity->artist)) {
           @$entity->artist = new \stdClass;
        } else {
           @$entity->artist = (new ArtistFormat)->setForApi($entity->artist);
        }

        if (!isset($entity->album) || is_null($entity->album)) {
           @$entity->album = new \stdClass;
        } else {
           @$entity->album = (new AlbumFormat)->setForApi($entity->album);
        }

        unset($entity["created_at"]);
        unset($entity["updated_at"]);
        unset($entity["deleted_at"]);

        return $entity;
    }
}