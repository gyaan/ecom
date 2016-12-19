<?php
/**
 * Created by PhpStorm.
 * User: lenskart
 * Date: 15/12/16
 * Time: 13:41
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App
 */
class Category extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'parent_category_id', 'is_active'];

    protected $hidden = ['updated_at','created_at','is_active'];

    public function products()
    {
        return $this->hasMany('App\Products');
    }
}