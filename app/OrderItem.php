<?php
/**
 * Created by PhpStorm.
 * User: lenskart
 * Date: 15/12/16
 * Time: 13:57
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * Class OrderItem
 * @package App
 */
class OrderItem extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['product_id', 'products_count', 'order_id'];

    public function order()
    {
        return $this->belongsTo('App\Order');
    }

}