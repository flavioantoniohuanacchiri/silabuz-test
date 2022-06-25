<?php

use Illuminate\Database\Migrations\Migration;

class AddApiColumnsToUsersTable extends Migration
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
                ->enum("gender", ["F", "M", "O"])
                ->after("id")
                ->default("O");
            $table
                ->string("firstname", 300)
                ->after('name')
                ->index("IDX_USERS__FIRSTNAME")
                ->nullable();
            $table
                ->string("lastname")
                ->after('firstname')
                ->index("IDX_USERS__LASTNAME")
                ->nullable();
            $table
                ->string("country_code", 5)
                ->after('lastname')
                ->index("IDX_USERS__COUNTRY_CODE")
                ->nullable();
            $table
                ->string("language_code", 5)
                ->after('country_code')
                ->index("IDX_USERS__LANGUAGE_CODE")
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
            $table->dropColumn('gender');
            $table->dropColumn('firstname');
            $table->dropColumn('lastname');
            $table->dropColumn('country_code');
            $table->dropColumn('language_code');
        });
    }
}
