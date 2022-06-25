<?php

use Illuminate\Database\Migrations\Migration;

class AddDeletedAtColumnToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function ($table) {
            $table
                ->dateTime("deleted_at")
                ->after('updated_at')
                ->index("IDX_USERS__DELETED_AT")
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function ($table) {
            $table->dropColumn('deleted_at');
        });
    }
}
