<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     * select b.id, b.bus_registration_number , b.bus_name, br.route_name, b.bus_owner, b.bus_route from bus b
     */
    public function up(): void
    {
        Schema::create('bus', function (Blueprint $table) {
            $table->id();
            $table->string('bus_registration_number', 50);
            $table->string('bus_name', 100);
            $table->string('route_name', 100);
            $table->string('bus_route', 100);
            $table->string('bus_owner', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bus');
    }
};
