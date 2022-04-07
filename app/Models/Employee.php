<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_id',
        'first_name',
        'last_name',
        'email',
        'phone',
    ];

    // One To One Relationship Between Employee And Company Tables
    public function company()
    {
        return $this->belongsTo('App\Models\Company');
    }
}
