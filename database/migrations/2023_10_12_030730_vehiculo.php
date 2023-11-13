<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('vehiculo', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('tipo')->nullable();
            $table->biginteger('capacidad');
            $table->string('color');
            $table->binary('imagen_3d')->nullable();
            $table->unsignedBigInteger('usuario_id'); // Agrega esta línea para el campo usuario_id
            $table->foreign('usuario_id')->references('id')->on('users'); // Agrega esta línea para la clave foránea
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::table('vehiculo', function (Blueprint $table) {
            $table->dropForeign(['usuario_id']);
        });
        Schema::dropIfExists('vehiculo');
    }
};
