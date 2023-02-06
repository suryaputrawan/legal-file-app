<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Agreement extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'agreement';

    protected $fillable = [
        'name', 'nomor', 'counter_id', 'tglterbit',
        'tglexp', 'picture_path', 'file_path', 'unit_id'
    ];

    //Menampilkan Gambar yang disimpan pada storage
    public function getTakeImageAttribute()
    {
        return "/storage/" . $this->picture_path;
    }

    public function getTakeFileAttribute()
    {
        return "/storage/" . $this->file_path;
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function counter()
    {
        return $this->belongsTo(Counter::class);
    }
}
