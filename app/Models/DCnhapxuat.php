<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DCnhapxuat extends Model
{
    use HasFactory;

    protected $table = 'dcnhapxuat';

    protected $primaryKey = 'MADC';

    protected $dateFormat = 'd-m-Y';

    public $timestamps = false;

    protected $fillable = ['TENDC','DCNHAPXUAT'];
}
