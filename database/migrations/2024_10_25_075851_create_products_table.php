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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nama_product',100);
            $table->string('slug',100);
            $table->string('secondary_name');
            $table->decimal('weight', 10,2);
            $table->enum('barcode',['Code25', 'Code39', 'Code128']);
            $table->unsignedBigInteger('id_brand');
            $table->unsignedBigInteger('id_kategori');
            $table->unsignedBigInteger('id_unit');
            $table->decimal('price', 10,2);
            $table->text('image')->nullable();
            $table->timestamps();



            $table->foreign('id_brand')->references('id')->on('brand')->onDelete('cascade');
            $table->foreign('id_kategori')->references('id')->on('kategori')->onDelete('cascade');
            $table->foreign('id_unit')->references('id')->on('unit')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {

        Schema::dropIfExists('products');
        
    }
};