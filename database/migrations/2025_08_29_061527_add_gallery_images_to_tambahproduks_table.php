<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('tambahproduks', function (Blueprint $table) {
        $table->json('gallery_images')->nullable()->after('gambar');
    });
}

public function down()
{
    Schema::table('tambahproduks', function (Blueprint $table) {
        $table->dropColumn('gallery_images');
    });
}
};
