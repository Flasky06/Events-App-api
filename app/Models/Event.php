<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;
    protected $fillable = [
        'title', 'description', 'category_id', 'startdatetime', 'enddatetime',
        'ticketsavailable', 'price', 'location_type', 'link_url',
        'location_id', 'location_description', 'img_url'
    ];


    // Define the relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    // Define the relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    // Define the relationship with Location
    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}