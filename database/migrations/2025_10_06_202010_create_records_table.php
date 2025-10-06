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
        Schema::create('records', function (Blueprint $table) {
            $table->id();
            $table->string('string')->nullable(true)->default(null);
            $table->text('text')->nullable(true)->default(null);
            $table->json('json')->nullable(true)->default(null);
            $table->boolean('boolean')->nullable(false)->default(false);
            $table->integer('integer')->default(0);
            $table->float('float', 2)->default(0.00);
            $table->softDeletes();
            $table->timestamps();
        });

//        Schema::create('extended_data', function (Blueprint $table) {
//            $table->id();
//            $table->foreignId('record_id');
//            $table->string('string')->nullable(true)->default(null);
//            $table->text('text')->nullable(true)->default(null);
//            $table->json('json')->nullable(true)->default(null);
//            $table->boolean('boolean')->nullable(false)->default(false);
//            $table->integer('integer')->default(0);
//            $table->float('float', 2)->default(0.00);
//            $table->softDeletes();
//            $table->timestamps();
//        });
//
//        Schema::create('more_extended_data', function (Blueprint $table) {
//            $table->id();
//            $table->foreignId('record_id');
//            $table->string('string')->nullable(true)->default(null);
//            $table->text('text')->nullable(true)->default(null);
//            $table->json('json')->nullable(true)->default(null);
//            $table->boolean('boolean')->nullable(false)->default(false);
//            $table->integer('integer')->default(0);
//            $table->float('float', 2)->default(0.00);
//            $table->softDeletes();
//            $table->timestamps();
//        });
//
//        Schema::create('extended_extended_data', function (Blueprint $table) {
//            $table->id();
//            $table->foreignId('extended_data_id');
//            $table->string('string')->nullable(true)->default(null);
//            $table->text('text')->nullable(true)->default(null);
//            $table->json('json')->nullable(true)->default(null);
//            $table->boolean('boolean')->nullable(false)->default(false);
//            $table->integer('integer')->default(0);
//            $table->float('float', 2)->default(0.00);
//            $table->softDeletes();
//            $table->timestamps();
//        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('records');
    }
};
