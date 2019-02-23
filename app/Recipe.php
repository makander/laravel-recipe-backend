<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = ['user_id, yummly_recipe_id, recipe_name, image_url'];




    public function User()
    {
        return $this->belongsTo(User::class);
    }
}
