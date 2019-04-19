<?php

namespace App\Http\Controllers;

use App\User;
use App\Recipe;
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
        $recipes = Recipe::where('user_id', $request->user()->id)->get();
        return response()->json($recipes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        } else {
            return response()->json(['error' => 'Recipe already exists'], 401);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //  return Recipe::all()->where('user_id', '=', $id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function edit(Recipe $recipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Recipe  $recipe
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $recipe = Recipe::where('id', '=', $id);
        $recipe->delete();
        $recipes = Recipe::where('user_id', $request->user()->id)->get();
        return response()->json($recipes);
    }
}
