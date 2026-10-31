<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ReconcileProkersTableForAdmin extends Migration
{
    public function up()
    {
        $columns = [];

        if (!Schema::hasColumn('prokers', 'name')) {
            $columns[] = 'name';
        }
        if (!Schema::hasColumn('prokers', 'slug')) {
            $columns[] = 'slug';
        }
        if (!Schema::hasColumn('prokers', 'date')) {
            $columns[] = 'date';
        }
        if (!Schema::hasColumn('prokers', 'periode_id')) {
            $columns[] = 'periode_id';
        }
        if (!Schema::hasColumn('prokers', 'proposal')) {
            $columns[] = 'proposal';
        }
        if (!Schema::hasColumn('prokers', 'lpj')) {
            $columns[] = 'lpj';
        }
        if (!Schema::hasColumn('prokers', 'link_documentation')) {
            $columns[] = 'link_documentation';
        }

        if ($columns) {
            Schema::table('prokers', function (Blueprint $table) use ($columns) {
                foreach ($columns as $column) {
                    switch ($column) {
                        case 'name':
                        case 'slug':
                            $table->string($column)->nullable();
                            break;
                        case 'date':
                            $table->date($column)->nullable();
                            break;
                        case 'periode_id':
                            $table->unsignedBigInteger($column)->nullable();
                            break;
                        case 'proposal':
                        case 'lpj':
                        case 'link_documentation':
                            $table->text($column)->nullable();
                            break;
                    }
                }
            });
        }

        if (Schema::hasColumn('prokers', 'title') && Schema::hasColumn('prokers', 'name')) {
            DB::table('prokers')->whereNull('name')->update(['name' => DB::raw('title')]);
        }
        if (Schema::hasColumn('prokers', 'period_id') && Schema::hasColumn('prokers', 'periode_id')) {
            DB::table('prokers')->whereNull('periode_id')->update(['periode_id' => DB::raw('period_id')]);
        }
    }

    public function down()
    {
    }
}
