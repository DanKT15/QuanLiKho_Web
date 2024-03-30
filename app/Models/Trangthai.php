<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trangthai extends Model
{
    use HasFactory;

    protected $table = 'trangthai';

    protected $primaryKey = 'MATT';

    protected $dateFormat = 'd-m-Y';

    public $timestamps = false;

    protected $fillable = ['TENTT'];
}
