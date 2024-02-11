<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * @var string
     */
    protected $table = 'companies';

    /**
     * @var bool
     */
    public $timestamps = true;

    /**
     * @var string[]
     */
    protected $fillable = [
        'name',
        'owner_first_name',
        'owner_last_name',
        'phone',
        'address',
        'city',
        'country'
    ];

    /**
     * @return BelongsToMany
     */
    public function groups()
    {
        return $this->belongsToMany(Group::class, 'group_company', 'company_id', 'group_id');
    }
}
