<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->foreignId('post_id')->constrained('post'); // Cara Ke dua hasilnya sama dengan cara pertama
            $table->foreignId('tag_id')->constrained('tag'); // Cara Ke dua hasilnya sama dengan cara pertama
            $table->primary(['post_id', 'tag_id']);

            // Ketika data post dihapus maka data "post_id" pada tabel post_tag akan ikut terhapus
            // $table->foreign('post_id')->references('id')->on('post')->onDelete('cascade'); Ini Cara Pertama.

            // Ketika data tag dihapus maka data "tag_id" pada tabel post_tag akan ikut terhapus
            // $table->foreign('tag_id')->references('id')->on('tag')->onDelete('cascasde'); Ini Cara Pertama
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}
