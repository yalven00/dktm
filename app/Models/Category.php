<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;


 protected $table = 'categories';   

 protected $fillable = [
        'name',
        'note_id',
        'image_url'

    ];


  
public function notes()
{
    return $this->hasMany(Notes::class);
}


}

