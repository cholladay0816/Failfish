<?php

namespace App\Console\Commands;

use App\Models\Image;
use Illuminate\Console\Command;

class SetDailyImage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:setdailyimage';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sets the daily image of Austin';

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
        $christmas = now()->month(12)->day(25);
        $thanksgiving = now()->month(11)->week(4, 4);
        $easter = Image::calculateEaster();
        $images = Image::all();
        foreach ($images as $image) {
            $image->active = 0;
            $image->save();
        }
        if ($christmas->isCurrentDay()) {
            $this->comment('Today is Christmas');
            $image = Image::where('name', '=', 'austingrinch')->first();
            $image->active = 1;
            $image->save();
        } elseif ($thanksgiving->isCurrentDay()) {
            $this->comment('Today is Thanksgiving');
            $image = Image::where('name', '=', 'austinturkey')->first();
            $image->active = 1;
            $image->save();
        } elseif ($easter->isCurrentDay()) {
            $this->comment('Today is Easter');
            $image = Image::where('name', '=', 'austineaster')->first();
            $image->active = 1;
            $image->save();
        } elseif (now()->format('d') == '01') {
            $this->comment('Today is the 1st of the month');
            $image = Image::where('name', '=', 'austinfirst')->first();
            $image->active = 1;
            $image->save();
        } else {
            $weekday = strtolower(now()->dayName);
            $this->comment('Today is a normal '.$weekday);


            $daily = Image::where('name', '=', 'austin'.strtolower(now()->dayName))->first();
            if (isset($daily)) {
                $daily->active = 1;
                $daily->save();
            } else {
                $image = Image::where('name', '=', 'austin')->first();
                $image->active = 1;
                $image->save();
            }
        }
        return 0;
    }
}
