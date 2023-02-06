<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class IzinCorporate extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'izincorporate';

    protected $fillable = [
        'name', 'nomor', 'penerbit_id', 'tglterbit', 'tglexp',
        'picture_path', 'file_path', 'unit_id'
    ];

    public function getTakeImageAttribute()
    {
        return "/storage/" . $this->picture_path;
    }

    public function getTakeFileAttribute()
    {
        return "/storage/" . $this->file_path;
    }

    public function penerbit()
    {
        return $this->belongsTo(Penerbit::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
