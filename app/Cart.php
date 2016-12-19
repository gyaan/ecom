<?php
/**
 * Created by PhpStorm.
 * User: lenskart
 * Date: 16/12/16
 * Time: 17:52
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    protected $fillable = ['product_id', 'product_quantity', 'user_id', 'order_id', 'status'];

    protected $hidden = ['updated_at','created_at'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

}