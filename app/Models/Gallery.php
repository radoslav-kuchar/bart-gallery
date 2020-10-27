<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Image;

class Gallery extends Model
{
    protected $fillable = [
        'name', 'slug',
    ];

    public function image(){
        return $this->hasMany(Image::class);
    }
    public function getImage(){
        $image = Image::where('gallery_id', $this->id)->first();
        if($image){
            return $image;
        }
        else
        {
            return null;
        }
        
    }
}
    
