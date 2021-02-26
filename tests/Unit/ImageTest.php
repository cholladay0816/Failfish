<?php

namespace Tests\Unit;

use App\Models\Image;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ImageTest extends TestCase
{
    use RefreshDatabase;
    /** @test */
    public function it_has_a_name()
    {
        $image = Image::factory()->create(['name' => 'test']);
        $this->assertEquals('test', $image->name);
    }
}
