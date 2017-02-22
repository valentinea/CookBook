<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    protected $fillable = [
        'type', 'text', 'title'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function ingredients(){
        return $this->belongsToMany(Ingredient::class)
            ->withPivot('size');
    }

    public function comments(){
    	return $this->hasMany(Comment::class);
    }

    public function image(){
        return $this->hasMany(Image::class);
    }
}
