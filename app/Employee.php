<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'company_id', 'email', 'phone',
    ];

    protected $perPage = 10;


    public function getNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }


    public function company()
    {
        return $this->belongsTo(Company::class);
    }
}
