<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Shop extends Model
{
    public function shop_profile(): HasOne
    {
        return $this->hasOne(ShopProfile::class);
    }
}
