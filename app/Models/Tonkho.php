<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tonkho extends Model
{
    use HasFactory;

    protected $table = 'tonkho';

    protected $primaryKey = 'id';

    protected $dateFormat = 'd-m-Y';

    public $timestamps = false;

    protected $fillable = ['MAKHO','MASP','SLTONKHO','SLNHAP','SLXUAT'];
}
