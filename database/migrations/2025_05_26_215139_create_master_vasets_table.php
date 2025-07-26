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
        Schema::create('master_vasets', function (Blueprint $table) {
            $table->id();
            $table -> string("lesson_id");
            $table -> string("uni_id");
            $table -> string("master_id");
            $table -> string("college_id");
            $table -> string("field_id");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_vasets');
    }
};
