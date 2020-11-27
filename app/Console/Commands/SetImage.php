<?php

namespace App\Console\Commands;

use App\Models\Image;
use Illuminate\Console\Command;

class SetImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:setimage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets the currently active image based on the date.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $christmas = new \Illuminate\Support\Carbon('2020-12-25 00:00:00', 'America/Chicago');
        $thanksgiving = new \Illuminate\Support\Carbon('2020-11-1','America/Chicago');
        $thanksgiving->timezone = 'America/Chicago';
        $thanksgiving->year(now()->year);
        $thanksgiving->month(11);
        $thanksgiving->addWeeks(3);
        $thanksgiving->addDays(4);

        $images = Image::all();
        foreach ($images as $image)
        {
            $image->active = 0;
            $image->save();
        }
        if($christmas->isCurrentDay())
        {
            $this->comment('Today is Christmas');
            $image = Image::where('name', '=', 'austingrinch')->first();
            $image->active = 1;
            $image->save();
        }
        elseif($thanksgiving->isCurrentDay())
        {
            $this->comment('Today is Thanksgiving');
            $image = Image::where('name', '=', 'austinturkey')->first();
            $image->active = 1;
            $image->save();
        }
        else
        {
            $this->comment('Today is a normal day');
            $image = Image::where('name', '=', 'austin')->first();
            $image->active = 1;
            $image->save();
        }
        return 0;
    }
}
