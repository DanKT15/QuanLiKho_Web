<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loaisp extends Model
{
    use HasFactory;

    protected $table = 'loaisp';

    protected $primaryKey = 'MALOAI';

    protected $dateFormat = 'd-m-Y';

    public $timestamps = false;

    protected $fillable = ['TENLOAI'];
}
