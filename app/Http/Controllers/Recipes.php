<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\User;
use App\Ingredient;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Recipes extends Controller
{
    
    public function dodajKomentar(Request $request, $id){

        $recept = Recipe::find($id);
        $comment = new Comment;
        $user = Auth::user();
        
        $comment->tekst = $request->komentar;
        $comment->user_id = $user->id;
        $comment->recipe_id = $recept->id;
        
        $recept->comments()->save($comment);
        $user->comments()->save($comment);

        return back();
    }

        public function obrisiRecept($id){

        DB::table('comments')->where('recipe_id', $id)->delete();
        DB::table('ingredient_recipe')->where('recipe_id', $id)->delete();
        
        Recipe::find($id)->delete();

        return view('mojiRecepti');
    }

    public function lajk($id){

        $user_id = Auth::user()->id;

        DB::table('like')->insert(['user_id'=>$user_id, 'recipe_id'=>$id]);

        return back();
    }
}
