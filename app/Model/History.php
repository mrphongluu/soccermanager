<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Player;
use App\Model\Schedule;

class History extends Model
{
    protected $table = 'historys';
    protected $fillable = [
        'option', 'reliability', 'schedule_id', 'player_id'
    ];
    // protected $primaryKey = null;

    public function schedules()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id', 'id');
    }

    public function players()
    {
        return $this->belongsTo(Player::class, 'player_id', 'id');
}}
