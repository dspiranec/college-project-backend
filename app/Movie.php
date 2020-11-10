<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable  = ['name', 'year_realase', 'movie_length', 'actors', 'director', 'imbd', 'description', 'picture_url', 'trailer_url'];
    public $timestamps = false;
    public $expired_on = "";

    /**
     * The users that belong to the movie.
     */
    public function users()
    {
        return $this->belongsToMany('App\User');
    }
}
