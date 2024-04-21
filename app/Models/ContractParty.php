<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContractParty extends Model
{
    use HasFactory;

    protected $fillable = [
        'unique_number',
        'full_name',
        'gender',
        'manner_of_transfer',
        'personal_sub_city',
        'personal_wereda',
        'personal_phone',
        'house_sub_city',
        'house_wereda',
        'site_name',
        'building_number',
        'floor_number',
        'house_number',
        'bedroom_number',
        'net_house_area',
        'common_area',
        'total_house_area',
        'price_per_square',
        'total_house_price',
        'category_id',
        'added_by',
    ];
    public function houses()
    {
        return $this->belongsToMany(House::class, 'bidder_house', 'bidder_id', 'house_id');
    }
    public function station()
    {
        return $this->belongsTo(Station::class, 'bidder_station_id');
    }
}
