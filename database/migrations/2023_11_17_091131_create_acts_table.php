<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('acts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('address');
            $table->date('date');
            $table->foreignId('service_id')->constrained();
            $table->foreignId('expert_id')->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('acts');
    }
};
