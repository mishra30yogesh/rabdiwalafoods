<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnOtherNameInSampleTastedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sample_tasted', function (Blueprint $table) {
            $table->text('other_name')->nullable();
        });
        
        Schema::table('samples', function (Blueprint $table) {
            DB::table('samples')->where('id', 10)->update([
                'name' => 'Other'
            ]);
        });
        
        Schema::table('contact_type', function (Blueprint $table) {
            DB::table('contact_type')->where('id', 5)->update([
                'name' => 'Other'
            ]);
        });
        
        Schema::table('products', function (Blueprint $table) {
            DB::table('products')->where('id', 15)->update([
                'name' => 'Other'
            ]);
        });
        
        Schema::table('restaurant_type', function (Blueprint $table) {
            DB::table('restaurant_type')->where('id', 8)->update([
                'name' => 'Other'
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
        Schema::table('sample_tasted', function (Blueprint $table) {
            $table->dropColumn('other_name');
        });
    }
}
