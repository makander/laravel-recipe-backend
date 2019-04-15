<?php

namespace App\Http\Controllers;

use App\Recipe;
use App\Http\Resources\RecipeResource;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return Recipe::all()->where('user_id', '=', $request->user()->id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $UserRecipes = Recipe::all()->where('user_id', '=', $request->user()->id)->
        where('yummly_recipe_id', '==', $request->yummly_recipe_id)->isEmpty();

        if ($UserRecipes) {
            $recipe = Recipe::create([
            'user_id' => $request->user()->id,
            'yummly_recipe_id' => $request->yummly_recipe_id,
            'recipe_name' => $request->recipe_name,
            'image_url' => $request->image_url
        ]);
            return new RecipeResource($recipe);
        } else {
            return response('Already exists', 500)
            ->header('Content-Type', 'text/plain');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        
        $recipe = Recipe::where('id', '=', $id);
        $recipe->delete();
        return Recipe::all()->where('user_id', '=', $request->user()->id);
    }
}