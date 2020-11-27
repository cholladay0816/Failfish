<?php

namespace Database\Seeders;

use App\Models\Image;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $default = new Image(['name'=>'austin', 'active'=>1]);
        $default->save();
        $thanksgiving = new Image(['name'=>'austinturkey']);
        $thanksgiving->save();
        $christmas = new Image(['name'=>'austingrinch']);
        $christmas->save();
    }
}
