<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ReconcileProfilesTableForUploads extends Migration
{
    public function up()
    {
        $columns = [];

        if (!Schema::hasColumn('profiles', 'name')) {
            $columns[] = 'name';
        }
        if (!Schema::hasColumn('profiles', 'description')) {
            $columns[] = 'description';
        }
        if (!Schema::hasColumn('profiles', 'address')) {
            $columns[] = 'address';
        }
        if (!Schema::hasColumn('profiles', 'address_link')) {
            $columns[] = 'address_link';
        }
        if (!Schema::hasColumn('profiles', 'telpon')) {
            $columns[] = 'telpon';
        }
        if (!Schema::hasColumn('profiles', 'email')) {
            $columns[] = 'email';
        }
        if (!Schema::hasColumn('profiles', 'logo')) {
            $columns[] = 'logo';
        }
        if (!Schema::hasColumn('profiles', 'organization')) {
            $columns[] = 'organization';
        }
        if (!Schema::hasColumn('profiles', 'filosofi_logo')) {
            $columns[] = 'filosofi_logo';
        }

        if ($columns) {
            Schema::table('profiles', function (Blueprint $table) use ($columns) {
                foreach ($columns as $column) {
                    switch ($column) {
                        case 'name':
                            $table->string('name')->default('HIMASI UNUSA');
                            break;
                        case 'description':
                        case 'address':
                        case 'address_link':
                        case 'logo':
                        case 'organization':
                        case 'filosofi_logo':
                            $table->text($column)->nullable();
                            break;
                        case 'telpon':
                        case 'email':
                            $table->string($column)->default('');
                            break;
                    }
                }
            });
        }
    }

    public function down()
    {
    }
}
