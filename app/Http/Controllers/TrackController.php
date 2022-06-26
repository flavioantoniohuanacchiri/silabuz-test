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
use App\Formats\TrackFormat;

class TrackController extends Controller
{
    protected $_trackEntity;
    public function __construct(
         TrackEntity $trackEntity
    ) {
        $this->middleware('auth:sanctum');
        $this->_trackEntity = $trackEntity;
    }
    
    public function index(Request $request) {
        $keyword = $request->has("q")? $request->q : "";
        if ($keyword == "") {
            return response()->json(["data" => []]);
        }
        $explodeFlags = explode(":", $keyword);

        switch ($explodeFlags[0]) {
            case 'track':
                # code...
                break;
            
            default:
                # code...
                break;
        }
        $whereConditionals = [
            "like" => [
                
            ]
        ];
        
    }
    public function search($keyword = "") {
        if ($keyword == "") {
            return response()->json(["data" => []]);
        }
        
    }
    public function show($id) {
        return response()->json($this->_trackEntity->find($id));
    }
    public function store(ArtistRequest $request) {
        return response()->json($this->_trackEntity->create($request->all()));
    }
    public function trackList(Request $request) {
        
    }
}