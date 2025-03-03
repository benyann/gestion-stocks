<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
    Schema::create('sales', function (Blueprint $table) {
        $table->id();
        $table->date('sale_date');
        $table->decimal('total_amount', 10, 2); // Augmenter la taille pour de gros montants
        $table->unsignedBigInteger('user_id'); // ID de l'utilisateur qui a effectué la vente
        $table->string('payment_method')->default('cash'); // Mode de paiement (cash, carte, mobile money...)
        $table->decimal('paid_amount', 10, 2)->default(0); // Montant payé par le client
        $table->decimal('change_amount', 10, 2)->default(0); // Montant rendu au client
        $table->timestamps();

        // Clé étrangère pour relier aux utilisateurs
        //$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
