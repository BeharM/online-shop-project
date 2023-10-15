<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    /**
     * The attributes that are guarded.
     *
     * @var array<int, string>
     */
    protected $guarded = [
        'id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'registration_date'=> 'datetime',
    ];

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, 'product_id');
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'product_tags', 'product_id', 'tag_id');
    }

    public function scopeFilter($q, $filter){
        if (isset($filter['search']) and !empty($filter['search'])) {
            $keyword=$filter['search'];
            $q->whereRaw("(
                    products.name  like '".$keyword."%' or
                    products.engine_size  like '".$keyword."%' or
                    products.price like '%".$keyword."%'
            )");
        }

        return $q;
    }
}
