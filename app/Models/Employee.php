<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $fillable = [
        'nik', 'name',
        'pob', 'dob',
        'sex', 'address',
        'telphone', 'isaktif'
    ];

    public function izinnakes()
    {
        return $this->hasMany(IzinNakes::class);
    }
}
