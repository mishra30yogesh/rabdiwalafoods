<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnContactNoInUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->bigInteger('contact_no')->nullable();
        });
        
        Schema::table('orders', function (Blueprint $table) {
            $table->boolean('is_deleted')->default(FALSE);
        });
        
        Schema::table('sample_given', function (Blueprint $table) {
            $table->text('remark')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('contact_no');
        });
        
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('is_deleted');
        });
        
        Schema::table('sample_given', function (Blueprint $table) {
            $table->dropColumn('remark');
        });
    }
}
