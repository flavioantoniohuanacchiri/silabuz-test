<?php namespace App\Formats;

class AlbumFormat {
	public function setForApi($entity) {
		@$entity->available = ($entity->available == 1)? true : false;
		@$entity->explicit_lyrics = ($entity->explicit_lyrics == 1)? true : false;
        @$entity->type = "album";

        if (isset($entity->tracks) && count($entity->tracks) > 0) {
        	@$entity->tracks = new \stdClass;
        	@$entity->tracks->data = [];
        }
        unset($entity["created_at"]);
        unset($entity["updated_at"]);
        unset($entity["deleted_at"]);



        return $entity;
	}
}