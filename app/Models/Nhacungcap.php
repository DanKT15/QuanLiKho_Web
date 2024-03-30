<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nhacungcap extends Model
{
    use HasFactory;

    protected $table = 'nhacungcap';

    protected $primaryKey = 'MANCC';

    protected $dateFormat = 'd-m-Y';

    public $timestamps = false;

    protected $fillable = ['TENNCC','SDT','DC'];
}
