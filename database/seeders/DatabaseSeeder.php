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
        Image::create(['name'=>'austin', 'active' => 1]);
        Image::create(['name'=>'austinturkey']);
        Image::create(['name'=>'austingrinch']);
        Image::create(['name'=>'austineaster']);
        Image::create(['name'=>'austinfirst']);

        Image::create(['name'=>'austinsunday']);
        Image::create(['name'=>'austinmonday']);
        Image::create(['name'=>'austintuesday']);
        Image::create(['name'=>'austinwednesday']);
        Image::create(['name'=>'austinthursday']);
        Image::create(['name'=>'austinfriday']);
        Image::create(['name'=>'austinsaturday']);

        Image::create(['name'=>'jerma']);
    }
}
