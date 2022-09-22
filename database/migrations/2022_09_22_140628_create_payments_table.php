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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->dateTime('date');
            $table->uuid('user_id');
            $table->uuid('employer_id');
            $table->string('avg_hour');
            $table->string('hours');
            $table->enum('taxable', ['Yes', 'No']);
            $table->enum('status', ['Complete', 'Pending']);
            $table->enum('shift_type', ['Day', 'Night']);
            $table->dateTime('paid_at');
            $table->timestamps();

            // -----------Foreign keys-----------
            // user_id connecting to Users table
            // employer_id connecting to Employers table
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('employer_id')->references('id')->on('employers')->onDelete('cascade');

            // Not creating duplicates is a key for performance and storage
            // Creating composite unique keys with user_id, client_id, date so duplicates don't happen
            $table->unique(['user_id', 'employer_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
};
