<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'logo', 'website',
    ];

    protected $perPage = 10;

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
