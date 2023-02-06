<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    use HasFactory;

    protected $table = 'unit';

    protected $fillable = ['name', 'alias', 'address', 'telphone', 'npwp'];


    public function agreement()
    {
        return $this->hasMany(Agreement::class);
    }

    public function izincorporate()
    {
        return $this->hasMany(IzinCorporate::class);
    }

    public function izinnakes()
    {
        return $this->hasMany(IzinNakes::class);
    }
}
