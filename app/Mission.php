<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Mission extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('App\Category');
    }

    public function steps()
    {
        return $this->hasMany('App\Step');
    }

    public function latest_step()
    {
        return $this->steps()->orderBy('date', 'DESC')->first();
    }

    public function latest_step_string()
    {
        if ( $latest_step = $this->latest_step() )
        {
            $week = [
                '日', //0
                '月', //1
                '火', //2
                '水', //3
                '木', //4
                '金', //5
                '土', //6
              ];
            $yobi = $week[Carbon::createFromFormat('Y-m-d', $latest_step->date)->format('w')];
            return '最終記録：' . Carbon::createFromFormat('Y-m-d', $latest_step->date)->format('n/j') . '(' . $yobi .') ' . $latest_step->score . $this->score_unit;
        }
        return '最終記録：未実施';
    }
}
