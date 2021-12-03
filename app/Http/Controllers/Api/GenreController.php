<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\GenreResource;
use App\Http\Resources\UserResource;
use App\Models\Genre;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class GenreController extends Controller
{

    public  function index(){
        $genres=Genre::all();
        return response()->api(GenreResource::collection($genres));
    }

    
}//end of controller
