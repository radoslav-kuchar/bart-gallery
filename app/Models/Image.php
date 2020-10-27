<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Gallery;

class Image extends Model
{
    protected $fillable = [
        'gallery_id', 'filename',
    ];
    public function gallery(){
        return $this->belongsTo(Gallery::class);
    }
}
