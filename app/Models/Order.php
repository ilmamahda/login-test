<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Eloquent;

class Order extends Eloquent
{
    use HasFactory;
    protected $table = 'tb_order';
    protected $guarded = 'id';
}
