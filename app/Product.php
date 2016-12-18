<?php
/**
 * Created by PhpStorm.
 * User: lenskart
 * Date: 15/12/16
 * Time: 09:24
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Product
 * @package App
 */
class Product extends Model
{

    /**
     * @var array
     */
    protected $fillable = ['name', 'sku', 'category_id', 'thumb_image', 'image', 'selling_price', 'cost_price', 'quantity', 'is_feature', 'is_active'];


    public function category()
    {
        $this->belongsTo('App\Category');
    }

}