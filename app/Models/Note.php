<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;


 protected $table = 'notes';



  protected $fillable = [
        'name',
        'user_id',
        'category_id',
        'image_url'

    ];


   public function user()
    {
        return $this->belongsTo(User::class);
    }


   public function category()
    {

       return $this->belongTo(Category::class);
    
   }


}
