<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    protected $table = "brands";
    protected $fillable = ["name"];

    public function racket()
    {
        return $this->hasMany("App\Racket", "brand_id", "id");
    }
}
