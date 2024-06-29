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
        Schema::create('client_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('service_option_id')->unsigned();
            $table->foreign('service_option_id')->references('id')->on('service_options')->onDelete('cascade');
            $table->string('status', 100)->nullable()->default('unactive');
            $table->integer('duration')->nullable()->default(12);
            $table->string('autorenewal', 100)->nullable()->default('yes');
            $table->string('posnumber', 200)->nullable();
            $table->date('startdate')->nullable();
            $table->date('duedate')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client_subscriptions');
    }
};
