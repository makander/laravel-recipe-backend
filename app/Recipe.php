<?php

namespace App;

<<<<<<< HEAD
=======
use App\User;
>>>>>>> tmp
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['user_id', 'yummly_recipe_id', 'recipe_name', 'image_url'];

<<<<<<< HEAD
=======

>>>>>>> tmp
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
