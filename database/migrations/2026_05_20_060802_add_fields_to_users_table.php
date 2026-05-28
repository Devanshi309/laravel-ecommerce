<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->string('image')
                  ->nullable();

            $table->string('phone')
                  ->nullable();

            $table->string('gender')
                  ->nullable();

            $table->date('dob')
                  ->nullable();

            $table->text('address')
                  ->nullable();

            $table->string('city')
                  ->nullable();

            $table->string('state')
                  ->nullable();

            $table->string('country')
                  ->nullable();

            $table->string('zipcode')
                  ->nullable();

            $table->softDeletes();

        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {

            $table->dropColumn([

                'image',
                'phone',
                'gender',
                'dob',
                'address',
                'city',
                'state',
                'country',
                'zipcode',
                'deleted_at'

            ]);

        });
    }
};