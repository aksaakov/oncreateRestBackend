<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLoyaltyProgramToCustomers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customers', function(Blueprint $table)
        {
            $table->integer('loyalty_points')->default(0);
            $table->integer('loyalty_reward')->default(0);
            $table->float('ordered_money_left')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customers', function(Blueprint $table)
        {
            $table->dropColumn(['loyalty_points', 'loyalty_reward', 'ordered_money_left']);
        });
    }
}
