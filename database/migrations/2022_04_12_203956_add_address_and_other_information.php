<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {

            $table->date('date_of_birth')->after('name')->nullable()->default(null);
            $table->year('angkatan')->after('name')->nullable()->default(null);
            $table->string('username')->after('email')->unique()->nullable()->default(null);
            $table->string('gender')->after('email')->nullable()->default(null);

            $table->boolean('active')->after('password')->default('0');
            $table->string('role')->after('name')->default(User::ROLE_MEMBER);

            $table->text('bio')->after('name')->nullable()->default(null);
            $table->string('profesi')->after('name')->nullable()->default(null);
            $table->string('foto')->after('name')->nullable()->default(null);
            $table->string('telepon')->after('name')->nullable()->default(null);
            $table->string('whatsapp')->after('name')->nullable()->default(null);
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
            $table->dropColumn('date_of_birth');
            $table->dropColumn('angkatan');
            $table->dropColumn('username');
            $table->dropColumn('gender');
            $table->dropColumn('active');
            $table->dropColumn('role');
            $table->dropColumn('profesi');
            $table->dropColumn('foto');
            $table->dropColumn('telepon');
            $table->dropColumn('whatsapp');
        });
    }
};
