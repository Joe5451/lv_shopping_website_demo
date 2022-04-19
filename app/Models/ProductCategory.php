<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;

    protected $table = 'product_category';
    protected $primaryKey = 'product_category_id';
    public $timestamps = false; // 不存在 created_at 和 updated_at
    
    const DISABLED = 'disabled';
    const ENABLED = 'enabled';

    const display_statuses = [
        0 => self::DISABLED,
        1 => self::ENABLED,
    ];

    protected $fillable = [
        'product_category_id',
        'category_name',
        'display',
        'sequence',
    ];

    // public function prices()
    // {
    //     if (!$this->_prices){
    //         $this->_prices = $this->product_options->map(function($product_option){
    //             return $product_option->price;
    //         });
    //     }

    //     return $this->_prices;
    // }

    // public function brand()
    // {
    //     return $this->belongsTo(Brand::class);
    // }

    // public function subcategory()
    // {
    //     return $this->belongsTo(Subcategory::class);
    // }

    // public function product_options()
    // {
    //     return $this->hasMany(ProductOption::class);
    // }

    // public function publish_status_name()
    // {
    //     if (isset(self::published_statuses[$this->published_status])){
    //         return ucfirst(
    //             self::published_statuses[$this->published_status]
    //         );
    //     } else {
    //         return ucfirst(self::published_statuses[0]);
    //     }
    // }

    // public function is_draft()
    // {
    //     return self::published_statuses[$this->published_status] == self::DRAFT;
    // }

    // public function is_published()
    // {
    //     return self::published_statuses[$this->published_status] == self::ENABLED;
    // }
}
