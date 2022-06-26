<?php namespace App\Handlers\Repositories;

use App\Handlers\AlbumEntityInterface;
use App\Models\Album;
use App\Formats\AlbumFormat;
use Intervention\Image\Facades\Image as Image;
use DB;

class AlbumEntity implements AlbumEntityInterface {
	public function create($entity = []) {
		/*$image = $entity["image"];
		$name = $entity["name"];
		$nbAlbums = isset($entity["nb_album"])? $entity["nb_album"] : 0;
		$nbFans = isset($entity["nb_fan"])? $entity["nb_fan"] : 0;

		$mimeExplode = explode("/", $image["mime"]);
		$typeImage = strtolower($mimeExplode[1]);
		$decodedImage = base64_decode($image["data"]);
        
        $pathName = "images/artist/".time().".{$typeImage}";
        $pathNameSmall = "images/artist/".time()."-56x56.{$typeImage}";
        $pathNameMedium = "images/artist/".time()."-250x250.{$typeImage}";
        $pathNameBig = "images/artist/".time()."-500x500.{$typeImage}";
        $pathNameXl = "images/artist/".time()."-1000x1000.{$typeImage}";
		
		try {
			$pictureImage = Image::make($decodedImage)->resize(1920, 1920);
			\Storage::disk("public")->put($pathName, $pictureImage->stream());

			$pictureImage = Image::make($decodedImage)->resize(56, 56);
			\Storage::disk("public")->put($pathNameSmall, $pictureImage->stream());

			$pictureImage = Image::make($decodedImage)->resize(250, 250);
			\Storage::disk("public")->put($pathNameMedium, $pictureImage->stream());

			$pictureImage = Image::make($decodedImage)->resize(500, 500);
			\Storage::disk("public")->put($pathNameBig, $pictureImage->stream());

			$pictureImage = Image::make($decodedImage)->resize(1000, 1000);
			\Storage::disk("public")->put($pathNameXl, $pictureImage->stream());

		} catch (Exception $e) {
			return ["error" => true, "message" => $e->getMessage(). "|".$e->getLine()];
		}

		DB::beginTransaction();
		try {
			$artistObj = new Artist;
			$artistObj->name = $name;
			$artistObj->save();

			$artistObj->link = route("artist.show", ["id" => $artistObj->id]);
            $artistObj->share = route("artist.show", ["id" => $artistObj->id])."?utm_source=deezer&utm_content=artist-{$artistObj->id}&utm_term=0_1656207095&utm_medium=web";
            
            $artistObj->picture =asset($pathName);
            $artistObj->picture_small = asset($pathNameSmall);
            $artistObj->picture_medium = asset($pathNameMedium);
            $artistObj->picture_big = asset($pathNameBig);
            $artistObj->picture_xl = asset($pathNameXl);
            $artistObj->nb_album = $nbAlbums;
            $artistObj->nb_fan = $nbFans;
            $artistObj->tracklist = route("artist.trackList", ["id" => $artistObj->id]);
            $artistObj->save();

			DB::commit();

			return ["error" => false, "data" => (new AlbumFormat)->setForApi($artistObj)];
		} catch (Exception $e) {
			DB::rollback();
			return ["error" => true, "message" => $e->getMessage(). "|".$e->getLine()];
		}*/
	}
	public function update($entity = [], $entityId = null) {

	}
	public function delete($entityId = null) {

	}
	public function find($entityId = null) {
		$artistObj = Album::find($entityId);
		if (is_null($artistObj)) {
            return new \stdClass;
        }
        return (new AlbumFormat)->setForApi($artistObj);
	}
	public function list($whereConditionals = []) {
		$list = Album::select("*");

		if (isset($whereConditionals["like"])) {
			foreach($whereConditionals["like"] as $key => $value) {
				$list->where($key, "like", "%".strtoupper($value)."%");
			}
		}

		return $list;
	}
}