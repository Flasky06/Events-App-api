<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    /** @use HasFactory<\Database\Factories\LocationFactory> */
    use HasFactory;

    protected $fillable = ['location'] ;

    // Define the relationship with Event
    public function events()
    {
        return $this->hasMany(Event::class);
    }

}
