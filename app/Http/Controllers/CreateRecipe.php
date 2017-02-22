<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\User;
use App\Ingredient;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CreateRecipe extends Controller
{

    public function dodajRecept(Request $request){
        
        $this->validate($request, [
        'type' => 'required|max:40|regex:/^[a-zA-Z ]+$/',
        'title' => 'required|max:30',
        'image' => ''
        ]);

        $path = $request->file('image')->store('images/'.auth()->id());

        $recept = new Recipe;
        $recept->type = $request->type;
        $recept->title = $request->title;
        $recept->text = "";
        $user = Auth::user();
        $user->recipes()->save($recept);
        
        DB::table('images')->insert(['recipe_id' => $recept->id, 'path' => $path]);
        
        $recept = Recipe::where('title', $request->title)->first();

        return view('newRecipe2', compact('recept'));
    }

    public function dodajSastojak(Request $request, $id){

        $this->validate($request, [
        'ingredient' => 'required|max:30|regex:/^[a-zA-Z ]+$/',
        'size' => 'required|max:30'
        ]);

        $recept = Recipe::find($id);
        $ingredient = DB::table('ingredients')->where('name', $request->ingredient)->first();

        if( $ingredient === null ){  //ne postoji sastojak, dodati ga
            $ingredient = new Ingredient;
            $ingredient->name = $request->ingredient;
            $ingredient->save();
        }

        $postoji = DB::table('ingredient_recipe')->where('recipe_id', $id)->where('ingredient_id', $ingredient->id)->first();

        if( $postoji === null ){
            //ako vec nije dodana poveznica
            $recept->ingredients()->attach($ingredient->id, ['size' => $request->size]);
        }

        return view('newRecipe2', compact('recept'));
    }

        public function dodajText(Request $request, $id){

        $this->validate($request, [
        'text' => 'required',
        ]);

        $recept = Recipe::find($id);
        $recept->text = $request->text;
        $recept->save();

        return view('mojiRecepti');
    }

    public function prijedi($id){
        $recept = Recipe::find($id);

        return view('newRecipe3', compact('recept'));
    }
}
