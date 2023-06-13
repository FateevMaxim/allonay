<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientTrackList extends Model
{
    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function trackList()
    {
        return $this->belongsTo(TrackList::class, 'track_code', 'track_code');
    }
}
