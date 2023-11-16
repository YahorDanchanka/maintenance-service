<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('material_service', function (Blueprint $table) {
            $table->id();
            $table->foreignId('material_id')->constrained();
            $table->foreignId('service_id')->constrained();
            $table->integer('count')->unsigned();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('material_service');
    }
};
