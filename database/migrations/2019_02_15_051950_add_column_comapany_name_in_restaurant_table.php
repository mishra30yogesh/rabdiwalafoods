<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnComapanyNameInRestaurantTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('restaurant', function (Blueprint $table) {
            $table->text('company_name')->nullable();
        });
        
        Schema::table('orders', function (Blueprint $table) {
            $table->text('restaurant_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('restaurant', function (Blueprint $table) {
            $table->dropColumn('company_name');
        });
        
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('restaurant_id');
        });
    }
}
