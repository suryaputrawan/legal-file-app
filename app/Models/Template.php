<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Template extends Model
{
    use HasFactory;

    protected $table = 'template';

    protected $fillable = ['name', 'file_path', 'category_id'];

    //Menampilkan File yang disimpan pada storage
    public function getTakeFileAttribute()
    {
        return "/storage/" . $this->file_path;
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
