<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $guarded = [];


    public static function calculateEaster()
    {
        // Thank you reddit lamp guy for this code
        // https://www.reddit.com/r/arduino/comments/65sa0p/turns_out_programmatically_figuring_out_what_day/
        $easterDay = (19 * (now()->year % 19) + 24) % 30;
        $easterDay = 22 + $easterDay + ((2 * (now()->year % 4) + 4 * (now()->year % 7) + 6 * $easterDay + 5) % 7);

        if( $easterDay > 31 ) {
            $easterMonth = 4;
            $easterDay -= 31;
        } else {
            $easterMonth = 3;
        }

    return Carbon::now()->month($easterMonth)->day($easterDay);

    }
}
