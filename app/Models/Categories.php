<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categories extends Model
{
    use HasFactory;

    Protected $fillable = ['Name_Category'];
    Protected $primaryKey = 'ID_Category';
    public $timestamps = true;

    public function books()
    {
        return $this->hasMany(Books::class, 'ID_Category');
    }
}
