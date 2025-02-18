<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployerList extends Model
{
    use HasFactory;


    protected $table = 'employer_lists';



  protected $fillable = [
        'manager_id',
        'employer_id',

    ];

}
