<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Player;
use App\Model\History;
use App\User;
use App\Model\Type;

class Schedule extends Model
{
    protected $table = 'schedules';
    protected $fillable = [
        'address', 'time', 'type_id', 'manager_id',
    ];
    protected $primaryKey ='id';

    public function logPlayers()
    {
        return $this->belongsToMany(Player::class, 'history', 'schedule_id', 'player_id');
    }

    public function historys()
    {
        return $this->hasMany(History::class, 'schedule_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'manager_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(Type::class, 'type_id', 'id');
    }

    public function delete()
    {
        $this->historys()->delete();
        return parent::delete();
    }
}
