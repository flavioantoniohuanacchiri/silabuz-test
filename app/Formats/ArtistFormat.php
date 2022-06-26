<?php namespace App\Formats;

class ArtistFormat {
	public function setForApi($entity) {
		@$entity->radio = ($entity->radio == 1)? true : false;
        @$entity->type = "artist";
        unset($entity["created_at"]);
        unset($entity["updated_at"]);
        unset($entity["deleted_at"]);

        return $entity;
	}
}