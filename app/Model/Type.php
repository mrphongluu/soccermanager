<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Schedule;

class Type extends Model
{
    protected $table = 'types';
    protected $primaryKey ='id';
    protected $fillable = [
        'name'
    ];

    public function schedules()
    {
        return $this->hasMany(Schedule::class, 'type_id', 'id');
    }

    public function delete()
    {
        $listSchedules = $this->schedules;
        foreach ($listSchedules as $key => $value) {
            $value->historys()->delete();
        }
        $this->schedules()->delete();
        return parent::delete();
    }
}
