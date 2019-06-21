<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Racket extends Model
{
    protected $table = "rackets";
    protected $fillable = ["name","balance_point","description","image","brand_id"];

    public function brand()
    {
        return $this->belongsTo("App\Brand","brand_id","id");
    }
}
