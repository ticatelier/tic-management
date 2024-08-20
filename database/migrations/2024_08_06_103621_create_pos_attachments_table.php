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
        Schema::create('pos_attachments', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('client_subscription_id')->unsigned();
            $table->foreign('client_subscription_id')->references('id')->on('client_subscriptions')->onDelete('cascade');
            $table->string('type')->nullable();
            $table->string('path')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pos_attachments');
    }
};
