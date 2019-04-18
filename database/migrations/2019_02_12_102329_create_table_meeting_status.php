<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableMeetingStatus extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_status', function (Blueprint $table) {
            $table->increments('id');
            $table->text('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });
        
        Schema::table('meeting_status', function (Blueprint $table) {
            DB::table('meeting_status')->insert([
                [
                    'name' => 'Ready For Order',
                    'description' => 'Ready For Order',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Follow Up',
                    'description' => 'Follow Up',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Reschedule',
                    'description' => 'Reschedule',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ],
                [
                    'name' => 'Not Interested',
                    'description' => 'Not Interested',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                ]
            ]);
        });
        
        Schema::create('meeting_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('feedback_id');
            $table->integer('restaurant_id');
            $table->integer('contact_id');
            $table->text('pin_location');
            $table->integer('created_by');
            $table->integer('status_id')->nullable();
            $table->text('details')->nullable();
            $table->dateTime('reschedule_date')->nullable();
            $table->integer('updated_by')->nullable();
            $table->timestamps();
        });
        
        Schema::table('feedbacks', function (Blueprint $table) {
                $table->integer('status_id')->nullable();
                $table->text('details')->nullable();
                $table->dateTime('reschedule_date')->nullable();
                $table->integer('updated_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meeting_status');
        Schema::dropIfExists('meeting_logs');
        Schema::table('feedbacks', function (Blueprint $table) {
                $table->dropColumn('status_id');
                $table->dropColumn('details');
                $table->dropColumn('reschedule_date');
                $table->dropColumn('updated_by');
        });
    }
}
