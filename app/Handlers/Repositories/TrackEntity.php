<?php namespace App\Handlers\Repositories;

use App\Handlers\TrackEntityInterface;
use App\Models\Artist;
use App\Models\Track;
use App\Formats\TrackFormat;
use Intervention\Image\Facades\Image as Image;
use DB;

class TrackEntity implements TrackEntityInterface {
	public function create($entity = []) {
		/*$image = $entity["image"];
		$name = $entity["name"];
		$nbTracks = isset($entity["nb_Track"])? $entity["nb_Track"] : 0;
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
			$trackObj = new Artist;
			$trackObj->name = $name;
			$trackObj->save();

			$trackObj->link = route("artist.show", ["id" => $trackObj->id]);
            $trackObj->share = route("artist.show", ["id" => $trackObj->id])."?utm_source=deezer&utm_content=artist-{$trackObj->id}&utm_term=0_1656207095&utm_medium=web";
            
            $trackObj->picture =asset($pathName);
            $trackObj->picture_small = asset($pathNameSmall);
            $trackObj->picture_medium = asset($pathNameMedium);
            $trackObj->picture_big = asset($pathNameBig);
            $trackObj->picture_xl = asset($pathNameXl);
            $trackObj->nb_Track = $nbTracks;
            $trackObj->nb_fan = $nbFans;
            $trackObj->tracklist = route("artist.trackList", ["id" => $trackObj->id]);
            $trackObj->save();

			DB::commit();

			return ["error" => false, "data" => (new TrackFormat)->setForApi($trackObj)];
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
		$trackObj = Track::with(["artist", "album"])->find($entityId);
		if (is_null($trackObj)) {
            return new \stdClass;
        }
        return (new TrackFormat)->setForApi($trackObj);
	}
	public function list($whereConditionals = []) {
		$list = Track::with(["artist", "album"])->select("*");

		if (isset($whereConditionals["like"])) {
			foreach($whereConditionals["like"] as $key => $value) {
				switch ($key) {
					case 'artist':
					case 'album':
						$list->whereHas($key, function($query) use ($value) {
							foreach ($value as $key2 => $value2) {
								$query->where($key2, "like", "%".strtoupper($value2)."%");
							}
						});
						break;
					
					default:
						$list->where($key, "like", "%".strtoupper($value)."%");
						break;
				}
			}
		}

		if (isset($whereConditionals["likeOr"])) {
			foreach($whereConditionals["likeOr"] as $key => $value) {
				switch ($key) {
					case 'artist':
					case 'album':
						$list->whereHas($key, function($query) use ($value) {
							foreach ($value as $key2 => $value2) {
								$query->orWhere($key2, "like", "%".strtoupper($value2)."%");
							}
						});
						break;
					
					default:
						$list->orWhere($key, "like", "%".strtoupper($value)."%");
						break;
				}
			}
		}

		return $list;
	}
}