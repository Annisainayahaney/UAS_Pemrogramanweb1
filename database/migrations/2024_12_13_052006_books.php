<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id('ID_Buku');
            $table->string('Judul_Buku');
            $table->string('Nama_Penulis');
            $table->string('Nama_Penerbit');
            $table->year('Tahun_Terbit');
            $table->text('Sinopsis');
            $table->enum('status', ['publish', 'pending']);
            $table->unsignedBigInteger('ID_Category');
            $table->integer('Likes')->default(0);
            $table->integer('Dislikes')->default(0);
            $table->timestamps();

            $table->foreign('ID_Category')->references('ID_Category')->on('categories')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
