<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateHobbiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::table('hobbies')->insert([
            [
              'id' => '1',
              'name' => 'Deportes',
          ],
          [
              'id' => '2',
              'name' => 'Musica',
          ],
          [
              'id' => '3',
              'name' => 'Viajar',
          ],
          [
              'id' => '4',
              'name' => 'Tecnologia',
          ],
          [
              'id' => '5',
              'name' => 'Drones',
          ],
          [
              'id' => '6',
              'name' => 'Arte',
          ],
  ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
