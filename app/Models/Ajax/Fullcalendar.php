<?php

namespace App\Models\Ajax;

use Illuminate\Database\Eloquent\Model;

class Fullcalendar extends Model
{
    protected $guarded = ['id'];
    /**
     * fullcalendar用タイトルの取得
     *
     * @param integer
     * @return string
     */
    public function getStockNumberAttribute(): string
    {
        return $this->attributes['title'];
    }

    protected $appends = ['stock_number'];

//    public function getDateAttribute(){
//        return $this->start . $this->end;
////        dd($test);
//    }

//    public function setStockNumberAttribute($value)
//    {
//        return $this->attribute['title'] = $value;
//    }
//
//    protected $appends = array('stock_number');

}
