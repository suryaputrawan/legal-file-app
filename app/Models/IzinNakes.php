<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class IzinNakes extends Model
{
    use HasFactory, Notifiable;

    protected $table = 'izinnakes';

    protected $fillable = [
        'nomor', 'employee_id', 'department_id',
        'tglterbit', 'tglexp', 'picture_path', 'file_path', 'unit_id'
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

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
