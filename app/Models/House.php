<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\{Model, SoftDeletes};

class House extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'slug',
        'thumbnail',
        'about',
        'price',
        'bedroom',
        'bathroom',
        'certificate',
        'electric',
        'land_area',
        'building_area',
        'category_id',
        'city_id'
    ];

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function photos()
    {
        return $this->hasMany(HousePhoto::class);
    }

    public function interest()
    {
        return $this->hasMany(Interest::class);
    }

    public function facilities()
    {
        return $this->hasMany(HouseFacility::class, 'house_id');
    }

    public function mortgageRequests()
    {
        return $this->hasMany(MortgageRequest::class);
    }
}
