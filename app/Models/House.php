<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class House extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = [
        'building_number',
        'sub_city_wereda',
        'site_name',
        'house_number',
        'house_height',
        'bedroom_number',
        'floor_number',
        'net_house_area',
        'common_area',
        'total_house_area',
        'price_per_square',
        'category_id',
        'added_by',
        'updated_by',
    ];
    public function houseCategory()
    {
        return $this->belongsTo(HousesCategory::class, 'category_id');
    }

    public function addedBy()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
 
    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

}
