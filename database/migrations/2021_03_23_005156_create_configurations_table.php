<?php

use App\Models\Configuration;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigurationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configurations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean("value");
            $table->timestamps();
        });

        $configurations = [
            'false' => 'maintenance-mode',

        ];

        foreach($configurations as $value => $name){
            // $role = new Role();
            // $role->slug = $slug;
            // $role->name = $name;
            // $role->save();

            $config = Configuration::create([
                'name' => $name,
                'value' => $value
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('configurations');
    }
}
