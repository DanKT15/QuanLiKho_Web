<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phieunhapxuat extends Model
{
    use HasFactory;

    protected $table = 'phieunhapxuat';

    protected $primaryKey = 'id';

    protected $dateFormat = 'd-m-y';

    public $timestamps = false;

    protected $fillable = ['SOPHIEU','MANV','MADC','MATT','NGAYLAP'];
}
