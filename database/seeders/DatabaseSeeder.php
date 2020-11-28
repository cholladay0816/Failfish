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
        $default = new Image(['name'=>'austin', 'active'=>1]);
        $default->save();
        $thanksgiving = new Image(['name'=>'austinturkey']);
        $thanksgiving->save();
        $christmas = new Image(['name'=>'austingrinch']);
        $christmas->save();
        $easter = new Image(['name'=>'austineaster']);
        $easter->save();

        $sunday = new Image(['name'=>'austinsunday']);
        $sunday->save();

        $monday = new Image(['name'=>'austinmonday']);
        $monday->save();

        $tuesday = new Image(['name'=>'austintuesday']);
        $tuesday->save();

        $wednesday = new Image(['name'=>'austinwednesday']);
        $wednesday->save();

        $thursday = new Image(['name'=>'austinthursday']);
        $thursday->save();

        $friday = new Image(['name'=>'austinfriday']);
        $friday->save();

        $saturday = new Image(['name'=>'austinsaturday']);
        $saturday->save();
    }
}
