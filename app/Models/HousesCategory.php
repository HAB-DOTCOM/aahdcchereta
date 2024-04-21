<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class HousesCategory extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;
    protected $fillable = ['name', 'created_by', 'updated_by', 'description'];

    public function house()
    {
        return $this->hasMany(House::class, 'category_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

}
