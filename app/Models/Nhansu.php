<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nhansu extends Model
{
    use HasFactory;

    protected $table = 'nhansu';

    protected $primaryKey = 'id';

    protected $dateFormat = 'd-m-Y';

    public $timestamps = false;

    protected $fillable = ['MANV','MAKHO','QUANTRI'];
}
