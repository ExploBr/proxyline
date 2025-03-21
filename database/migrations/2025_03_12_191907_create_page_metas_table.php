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
        Schema::create('page_metas', function (Blueprint $table) {
             $table->id();
             $table->unsignedBigInteger('page_id');
             $table->string('name');
             $table->text('content')->nullable();
             $table->string('lang');
             
            
             $table->timestamps();
            
             $table->foreign('page_id','page_meta_page_fk')->references('id')->on('pages');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_metas');
    }
};
