<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use HasFactory;

    protected $table = 'counter';

    protected $fillable = ['name', 'alamat', 'telphone', 'email', 'npwp'];

    public function agreement()
    {
        return $this->hasMany(Agreement::class);
    }
}
