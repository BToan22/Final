<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Kjmtrue\VietnamZone\Models\Province;
// use Kjmtrue\VietnamZone\Models\District;
// use Kjmtrue\VietnamZone\Models\Ward;
use Vanthao03596\HCVN\Models\Province;
use Vanthao03596\HCVN\Models\District;
use Vanthao03596\HCVN\Models\Ward;

class Ship extends Model
{
    //
    use SoftDeletes;
    protected $table = 'ships';
    public function city()
    {
        return $this->belongsTo(Province::class, 'city_id', 'id');
    }
    // public function getCityName()
    // {
    //     // dd($this->city_id);
    //     $city = Province::first();
    //     dd($city);
    //     return $city->name;
    // }
}
