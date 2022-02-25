<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->foreignId('user_id')
            ->primary()
            ->constrained('users')
            ->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender',['male','female']);
            $table->date('brithday')->nullable();
            $table->string('address')->nullable();
            $table->string('city')->nullable();
            $table->char('country_code',2);
            $table->char('locale',5)->default(config('app.locale'));//Ar en fr
            $table->string('timezone')->default(config('app.timezone'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('profiles');
    }
}
