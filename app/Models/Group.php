<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Group extends Model
{
    use HasFactory;

    /**
     * @var string[]
     */
    protected $fillable =[
        'name',
        'slug'
    ];

    /**
     * @return BelongsToMany
     */
    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }
}
