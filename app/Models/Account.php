<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Account extends Model
{
    protected $primaryKey = "acount_num";
    public $timestamps = false;
    protected $fillable = ["first_name", "last_name", "balance"];
}
