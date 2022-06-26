<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Artist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\ArtistRequest;
use App\Handlers\Repositories\AlbumEntity;

class AlbumController extends Controller
{
    protected $_artistEntity;
    public function __construct(
         AlbumEntity $albumEntity
    ) {
        $this->middleware('auth:sanctum');
        $this->_albumEntity = $albumEntity;
    }
    
    public function show($id) {
        return response()->json($this->_albumEntity->find($id));
    }
    public function store(ArtistRequest $request) {
        return response()->json($this->_albumEntity->create($request->all()));
    }
    public function trackList(Request $request) {
        
    }
}