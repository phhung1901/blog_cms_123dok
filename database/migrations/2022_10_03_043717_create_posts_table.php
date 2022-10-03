<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id()->index();
            $table->string("title")->nullable();
            $table->string("slug")->nullable()->index();
            $table->text("content");
            $table->string("images")->nullable();
            $table->unsignedBigInteger("category_id")->index();
            $table->unsignedBigInteger("author_id")->index();
            $table->string("status")->index();
            $table->timestamps();
            $table->foreign("category_id")->references("id")->on("categories");
            $table->foreign("author_id")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
};
