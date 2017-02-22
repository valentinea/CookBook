<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Recipe;
use App\User;
use App\Ingredient;
use App\Comment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $recepti = Recipe::orderBy('timestamps')->take(20)->get();

        return view('home', compact('recepti'));
    }

    public function pogledajRecept($id){

        $recept = Recipe::find($id);
        $path = DB::table('images')->where('recipe_id', $id)->value('path');

        return view('recept', compact('recept', 'path'));
    }

    public function pretrazi(Request $request){

        $this->validate($request, [
        'searchTag' => 'required|regex:/^[123]/',
        'searchInput' => 'required'
        ]);

        

        $tipPretrage = $request->searchTag;
        $input = $request->searchInput;

        if($tipPretrage == 1){
            $recepti = Recipe::where('type', 'like', $input)->get();
        }
        else if($tipPretrage == 2){
            $ingredient = Ingredient::where('name', 'like', $input)->first();
            $recepti = $ingredient->recipes()->get();
        }
        else {
            $user = User::where('surname', 'like', $input)->orWhere('name', 'like', $input)->first();
            $id = $user->id;
            $recepti = Recipe::where('user_id', $id)->get();
        }

        return view('home', compact('recepti'));
    }

    public function najdraziRecepti(){
        
        $user_id = Auth::user()->id;
        $recepti_id = DB::table('like')->where('user_id', $user_id)->get(); //idovi usera i recepta

        $recepti = collect();

        foreach($recepti_id as $idovi){
            $recept = DB::table('recipes')->where('id', $idovi->recipe_id)->first();
            $recepti->push($recept);

        }

        return view('najdrazi_recepti', compact('recepti'));
    }


}
