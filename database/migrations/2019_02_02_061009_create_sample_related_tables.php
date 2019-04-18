<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSampleRelatedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('feedback_details');
        
        Schema::create('sample_tasted', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('feedback_id');
                $table->integer('sample_id');
                $table->integer('responce_id');
                $table->text('remarks');
                $table->boolean('is_active');
                $table->timestamps();
        });

        Schema::create('sample_given', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('feedback_id');
                $table->integer('sample_id');
                $table->boolean('is_active');
                $table->timestamps();
        });

        Schema::create('sample_interested', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('feedback_id');
                $table->integer('sample_id');
                $table->text('remarks');
                $table->boolean('is_active');
                $table->timestamps();
        });
        
        Schema::dropIfExists('restaurant_type');
        
        Schema::create('restaurant_type', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->text('description')->nullable();
                $table->boolean('is_active')->default(TRUE);
                $table->timestamps();
        });
        Schema::table('restaurant_type', function (Blueprint $table) {
            DB::table('restaurant_type')->insert([
                [
                    'name' => 'Restaurant',
                    'description' => 'Restaurant',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Hotel + Restaurant',
                    'description' => 'Hotel + Restaurant',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Café',
                    'description' => 'Café',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Caterer',
                    'description' => 'Caterer',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Caterer + Banquet',
                    'description' => 'Caterer + Banquet',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'General Trade',
                    'description' => 'General Trade',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Modern Trade',
                    'description' => 'Modern Trade',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Others (Mention)',
                    'description' => 'Others (Mention)',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sample_tasted');
        Schema::dropIfExists('sample_given');
        Schema::dropIfExists('sample_interested');
        Schema::dropIfExists('restaurant_type');
    }
}
