<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ActorResource;
use App\Http\Resources\GenreResource;
use App\Http\Resources\ImageResource;
use App\Http\Resources\MovieResource;
use App\Http\Resources\UserResource;
use App\Models\Genre;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MovieController extends Controller
{

    public  function index(){
        $movies=Movie::whenType(\request('type'))
            ->whenSearch(\request('search'))
            ->with('genres')
            ->paginate(10);
        $data['movies']=MovieResource::collection($movies)->response()->getData(true);
        return response()->api($data);
    }

    public  function toggleFavorite(){
        \auth()->user()->favoriteMovies()->toggle([\request('movie_id')]);
        return response()->api(null,0,'Movie toggled successfully');
    }


    public  function  images(Movie $movie){
        return response()->api(ImageResource::collection($movie->images));
    }

    public  function actors(Movie $movie){
        return response()->api(ActorResource::collection($movie->actors));
    }

    public  function  related_movies(Movie $movie){
        $movies=Movie::whereHas('genres',function ($q)use($movie){
            return $q->whereIn('name',$movie->genres()->pluck('name'));
        })
            ->where('id','!=',$movie->id)
            ->with('genres')
            ->paginate(10);

        return response()->api(MovieResource::collection($movies));
    }

    
}//end of controller
