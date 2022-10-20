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
        Schema::table('book_stores', function (Blueprint $table) {  
            $table->string('name')->nullable()->change();
            $table->integer('isbn')->nullable()->change();
            $table->decimal('value')->nullable()->change(); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('book_stores', function (Blueprint $table) {  
            $table->string('name')->change();
            $table->integer('isbn')->change();
            $table->decimal('value')->change(); 
        });
    }
};
