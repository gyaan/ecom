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
 * Class Order
 * @package App
 */
class Order extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['id', 'user_id', 'total_amount', 'total_items', 'status'];

    public function items()
    {
        return $this->hasMany('App\OrderItem');
    }
}