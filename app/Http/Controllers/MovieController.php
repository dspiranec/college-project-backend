<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Movie;
use App\User;
use Illuminate\Support\Facades\DB;

class MovieController extends Controller
{
    public function index(){
        return Movie::all();
    }

    public function show($id){
        //$movie = Movie::find($id)->firstOrFail();
        return Movie::where('id', $id)->firstOrFail();
    }

    public function store(Request $request){
        Movie::create($request -> all());
        return response() ->json(['added' => 'U have successfully added a movie!'], 201);
    }

    public function update(Request $request, $id){
        //$movie = Movie::update($request -> all());
        Movie::where('id', $id)->update($request->all());
        $movie = Movie::find($id);
        
        //return $movie;
        return response() ->json(['updated' => $movie], 200);
    }

    public function delete(Request $request, $id){
        $movie = Movie::findOrFail($id);
        $movie->delete();

        //return 204;
        return response() ->json(['deleted' => 'U have successfully deleted a movie!'], 204);
    }

    public function addToFavorites($userId, $movieId){
        //$currUser = auth()->user();
        $user = User::where('id', $userId)->firstOrFail();
        $movie = Movie::where('id', $movieId)->firstOrFail();

        $exists = $user->movies->contains($movieId);
        if($exists){
            return response() ->json(['alreadyAdded' => 'Already added to favorites'], 200);
        }
        $user->movies()->attach($movieId);
        //$user->save();

        return response() ->json(['addedToFav' => 'U have successfully added movie to your favorites!', 'movie' => $movie], 200);
    }

    public function removeFromFavorites($userId, $movieId){
        $user = User::where('id', $userId)->firstOrFail();
        $movie = Movie::where('id', $movieId)->firstOrFail();
        
        $exists = $user->movies->contains($movieId);
        if(!$exists){
            return response() ->json(['alreadyRemoved' => 'Already removed from favorites'], 200);
        }
        $user->movies()->detach($movieId);

        return response() ->json(['removed' => 'U have successfully removed movie from your favorites!', 'movie' => $movie], 200);
                                 
    }

    public function getAll($userId){
        $user=User::where('id', $userId)->firstOrFail();

        //return $user->movies()->where('user_id', $userId)->get();
        return $user->movies;
    }
}
