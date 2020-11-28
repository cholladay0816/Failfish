<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;

    public function likes()
    {
        return Vote::where('positive', 1)->andWhere('video_id', $this->id)->get();
    }

    public function votes()
    {
        return $this->hasMany(Vote::class);
    }
    public function uploader()
    {
        return $this->belongsTo(User::class);
    }
}
