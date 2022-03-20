<?php

namespace Database\Seeders;

use App\Models\Vuser;
use Illuminate\Database\Seeder;

class VuserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Vuser::factory(50)->create();
    }
}
