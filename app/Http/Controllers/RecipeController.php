<?php

use App\Recipe;
use App\Http\Resource\RecipeResource;

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except(['index']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return RecipeResource::collection(Recipe);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $recipe = Recipe::create([
            'user_id' => $request->user()->id,
            'yummly_recipe_id' => $request->yummly_recipe_id,
            'recipe_name' => $request->recipe_name,
            'image_url' => $request->image_url
        ]);
        return new RecipeResource($recipe);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Recipe $recipe)
    {
        return new RecipeResource($recipe);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Recipe $recipe)
    {
        if ($request->user()->id !== $recipe->user_id) {
            return response()->json(['error' => 'You can only edit your own recipes.'], 403);
        }
    
        $recipe->update($request->only(['recipe_name', 'image_url', 'yummly_recipe_id']));
    
        return new RecipeResource($recipe);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Recipe $Recipe)
    {
        $recipe->delete();
        
        return response()->json(null, 204);
    }
}
