<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kho extends Model
{
    use HasFactory;

    protected $table = 'kho';

    protected $primaryKey = 'MAKHO';

    protected $dateFormat = 'd-m-Y';

    public $timestamps = false;

    protected $fillable = ['TENKHO','SDT','DC'];
}
