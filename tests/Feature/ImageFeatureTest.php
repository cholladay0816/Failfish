<?php

namespace Tests\Feature;

use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ImageFeatureTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_is_set_on_the_1st_of_the_month()
    {
        // Set up database and set date to 1st of month
        $this->seed();
        $this->travelTo(now()->firstOfMonth());
        $this->artisan('db:setdailyimage');

        // Assert the active image is autinfirst
        $image = Image::where('active', '1')->first();
        $this->assertEquals('austinfirst', $image->name);
    }

    /** @test */
    public function it_is_set_on_christmas()
    {
        // Set up database and set date to 1st of month
        $this->seed();
        $this->travelTo(now()->month(12)->day(25));
        $this->artisan('db:setdailyimage');

        // Assert the active image is austingrinch
        $image = Image::where('active', '1')->first();
        $this->assertEquals('austingrinch', $image->name);
    }

    /** @test */
    public function it_is_set_on_easter()
    {
        // Set up database and set date to 1st of month
        $this->seed();
        $this->travelTo(Image::calculateEaster());
        $this->artisan('db:setdailyimage');

        // Assert the active image is austineaster
        $image = Image::where('active', '1')->first();
        $this->assertEquals('austineaster', $image->name);
    }

    /** @test */
    public function it_is_set_on_weekdays()
    {
        // We use a hard coded date here to make sure holidays don't fail test
        $date = Carbon::create('2021', '1', '3');

        $this->seed();

        // Sunday
        $this->travelTo($date->weekday(0));
        $this->artisan('db:setdailyimage');
        $image = Image::where('active', '1')->first();
        $this->assertEquals('austinsunday', $image->name);
        // Monday
        $this->travelTo($date->weekday(1));
        $this->artisan('db:setdailyimage');
        $image = Image::where('active', '1')->first();
        $this->assertEquals('austinmonday', $image->name);
        // Tuesday
        $this->travelTo($date->weekday(2));
        $this->artisan('db:setdailyimage');
        $image = Image::where('active', '1')->first();
        $this->assertEquals('austintuesday', $image->name);
        // Wednesday
        $this->travelTo($date->weekday(3));
        $this->artisan('db:setdailyimage');
        $image = Image::where('active', '1')->first();
        $this->assertEquals('austinwednesday', $image->name);
        // Thursday
        $this->travelTo($date->weekday(4));
        $this->artisan('db:setdailyimage');
        $image = Image::where('active', '1')->first();
        $this->assertEquals('austinthursday', $image->name);
        // Friday
        $this->travelTo($date->weekday(5));
        $this->artisan('db:setdailyimage');
        $image = Image::where('active', '1')->first();
        $this->assertEquals('austinfriday', $image->name);
        // Saturday
        $this->travelTo($date->weekday(6));
        $this->artisan('db:setdailyimage');
        $image = Image::where('active', '1')->first();
        $this->assertEquals('austinsaturday', $image->name);
    }
}
