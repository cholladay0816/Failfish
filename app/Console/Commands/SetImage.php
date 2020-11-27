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
        $thanksgiving = new \Illuminate\Support\Carbon(strtotime("november ".now()->year." fourth thursday"),
            'America/Chicago');
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
            $weekday = strtolower(now()->dayName);
            $this->comment('Today is a normal '.$weekday);


            $daily = Image::where('name', '=', 'austin'.strtolower(now()->dayName))->first();
            if(isset($daily))
            {
                $daily->active = 1;
                $daily->save();
            }
            else
            {
                $image = Image::where('name', '=', 'austin')->first();
                $image->active = 1;
                $image->save();
            }
        }
        return 0;
    }
}
