<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Schedule;
use App\Model\History;

class Player extends Model
{
    protected $table = 'players';
    protected $fillable = [
        'name'
    ];
    protected $primaryKey ='id';

    public function historyPlayers()
    {
        return $this->belongsToMany(Schedule::class, 'history', 'player_id', 'schedule_id');
    }

    public function history()
    {
        return $this->hasMany(History::class, 'player_id', 'id');
    }
}
