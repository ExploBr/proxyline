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
        Schema::create('seo_infos', function (Blueprint $table) {
            $table->id();
 
            $table->unsignedBigInteger('page_id')->nullable();
            $table->foreign('page_id','page_seo_page_fk')->references('id')->on('pages')->onDelete('cascade');;
            $table->unsignedBigInteger('post_id')->nullable();
            $table->foreign('post_id','post_seo_post_fk')->references('id')->on('posts')->onDelete('cascade');;
            $table->string('name');
            $table->text('content')->nullable();
            $table->string('lang');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seo_infos');
    }
};
