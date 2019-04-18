<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnDelDateInOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('orders', function (Blueprint $table) {
            $table->date('expected_delivery_date')->nullable();
            $table->time('expected_delivery_time')->nullable();
            $table->bigInteger('contact_no')->change();
            $table->bigInteger('alternate_no')->nullable()->change();
        });
        
        Schema::table('restaurant_contact', function (Blueprint $table) {
            $table->dateTime('email')->nullable()->change();
        });
        
        Schema::table('sample_tasted', function (Blueprint $table) {
                $table->text('remarks')->nullable()->change();
                $table->boolean('is_active')->default(TRUE)->change();
        });

        Schema::table('sample_given', function (Blueprint $table) {
                $table->boolean('is_active')->default(TRUE)->change();
        });

        Schema::table('sample_interested', function (Blueprint $table) {
                $table->text('remarks')->nullable()->change();
                $table->boolean('is_active')->default(TRUE)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('expected_delivery_date');
            $table->dropColumn('expected_delivery_time');
        });
    }
}
