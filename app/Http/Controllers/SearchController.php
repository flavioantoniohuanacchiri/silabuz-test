<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ArtistRequest;
use App\Handlers\Repositories\TrackEntity;
use App\Handlers\Repositories\ArtistEntity;
use App\Formats\TrackFormat;
use App\Formats\ArtistFormat;

class SearchController extends Controller
{
    protected $_trackEntity;
    protected $_artistEntity;

    public function __construct(
         TrackEntity $trackEntity,
         ArtistEntity $artistEntity
    ) {
        $this->middleware('auth:sanctum');
        $this->_trackEntity = $trackEntity;
        $this->_artistEntity = $artistEntity;
    }
    
    public function index(Request $request) {
        $keyword = $request->has("q")? $request->q : "";
        if ($keyword == "") {
            return response()->json(["data" => []]);
        }
        $explodeFlags = explode("=", $keyword);
        
        if (!isset($explodeFlags[0])) {
            return response()->json(["data" => []]);
        }
        $explodeMultipleConditions = explode('" ', $explodeFlags[0]);
        $resultSearch = [];
        
        if (count($explodeMultipleConditions) == 1) {
            $explodeParameters = explode(":", $explodeMultipleConditions[0]);
            if (count($explodeParameters) <=0 || count($explodeParameters) >2) {
                return response()->json(["data" => []]);
            }

            if (count($explodeParameters) == 2) {
                $keywordTmp = preg_replace("/\"/", "", $explodeParameters[1]);
                
                switch ($explodeParameters[0]) {
                    case 'artist':
                        $whereConditionals = [
                            "like" => [
                                "artist" => [
                                    "name"  => $keywordTmp
                                ]
                            ]
                        ];
                        $resultSearch = $this->_trackEntity->list($whereConditionals)->get();
                        break;
                    case 'album':
                        $whereConditionals = [
                            "like" => [
                                "album" => [
                                    "title"  => $keywordTmp
                                ]
                            ]
                        ];
                        $resultSearch = $this->_trackEntity->list($whereConditionals)->get();
                        break;
                    case 'track':
                        $whereConditionals = [
                            "like" => [
                                "title" => $keywordTmp
                            ]
                        ];
                        $resultSearch = $this->_trackEntity->list($whereConditionals)->get();
                        break;
                    default:
                        # code...
                        break;
                }
            } else {
                $keywordTmp = preg_replace("/\"/", "", $explodeParameters[0]);
                $whereConditionals = [
                    "likeOr" => [
                        "title" => $keywordTmp,
                        "artist"    => [
                            "name"  => $keywordTmp
                        ],
                        "album" => [
                            "title" => $keywordTmp
                        ]
                    ]
                ];
                $resultSearch = $this->_trackEntity->list($whereConditionals)->get();
            }
            
            
        } else {
            $whereConditionals = [];
            $whereConditionals["likeOr"] = [];
            foreach ($explodeMultipleConditions as $key => $value) {
                $explodeParameters = explode(":", $value);
                $keywordTmp = preg_replace("/\"/", "", $explodeParameters[1]);
                switch ($explodeParameters[0]) {
                    case 'artist':
                    case 'album':
                        $whereConditionals["likeOr"][$explodeParameters[0]] = $keywordTmp;
                        break;
                    
                    default:
                        
                        break;
                }
            }
        }
        if (count($resultSearch) <=0) {
            return response()->json(["data" => []]);
        }
        $resultList = [];
        foreach ($resultSearch as $key => $value) {
            $resultList[] = (new TrackFormat)->setForApi($value);
        }
        return response()->json(["data" => $resultList]);
    }
}
