<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Agreement extends Model
{
    use HasFactory, SoftDeletes;
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'bidder_id',
        'house_id',
        'agreement_number',
        'witness_fullname_1',
        'witness_subcity_1',
        'witness_wereda_1',
        'witness_houseno_1',
        'witness_date_1',
        'witness_fullname_2',
        'witness_subcity_2',
        'witness_wereda_2',
        'witness_houseno_2',
        'witness_date_2',
        'witness_fullname_3',
        'witness_subcity_3',
        'witness_wereda_3',
        'witness_houseno_3',
        'witness_date_3',
        'document',
        'added_by',
        'updated_by',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
