<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;

    protected $table = 'books';
    protected $fillable = ['ID_Buku', 'Judul_Buku', 'Nama_Penulis', 'Nama_Penerbit', 'Tahun_Terbit', 'Sinopsis', 'ID_Category', 'status', 'likes', 'dislikes'];
    protected $primaryKey = 'ID_Buku';
    public $incrementing = true;
    public $timestamps = true;

    public function category()
    {
        return $this->belongsTo(Categories::class, 'ID_Category', 'ID_Category');
    }
}
