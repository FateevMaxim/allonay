<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('configurations', function (Blueprint $table) {
            $table->string('address_talgar')->nullable();
        });

        DB::table('configurations')->update([
            'address_talgar' => '收件人： ALL10i 手机号：15360461789 广东省佛山市南海区 里水镇里广路516号百顺产业园A09号仓唛头ALL10i(номер телефона) ALL10i',


        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('configurations', function (Blueprint $table) {
            $table->dropColumn('address_talgar');
        });
    }
};
