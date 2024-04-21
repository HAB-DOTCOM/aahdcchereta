<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use App\Models\HousesCategory;

class Bidder extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'age',
        'is_disabled',
        'region',
        'sub_city',
        'wereda',
        'bidder_house_number',
        'phone',
        'house_phone',
        'office_phone',
        'pox',
        'id_number',
        'nationality',
        'house_id',
        'added_by',
        'updated_by',
        'price_per_square',
        'total_price',
        'cpo_Bank_name',
        'cpo_Bank_branch',
        'cpo_number',
        'cpo_amount',
        'receipt_number',
        'status',
        'bidder_station_id',
        'rank',
        'reason',
        'special_reason',
        'cpo_Bank_account',
        'cpo_person_name',
    ];


    public function houses()
    {
        return $this->belongsToMany(House::class, 'bidder_house', 'bidder_id', 'house_id');
    }
    public function station()
    {
        return $this->belongsTo(Station::class, 'bidder_station_id');
    }
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }
}
