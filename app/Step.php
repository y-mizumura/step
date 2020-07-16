<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Step extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function mission()
    {
        return $this->belongsTo('App\Mission');
    }

    public function getFormattedDateAttribute()
    {
        Carbon::setLocale('ja');
        return Carbon::createFromFormat('Y-m-d', $this->attributes['date'])->isoFormat('M/D(ddd)');
    }
}
