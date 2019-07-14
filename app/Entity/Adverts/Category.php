<?php
/**
 * Created by PhpStorm.
 * User: cheremhovo1990
 * Date: 09.07.19
 * Time: 6:21
 */
declare(strict_types=1);


namespace App\Entity\Adverts;


use Illuminate\Database\Eloquent\Model;
use Kalnoy\Nestedset\NodeTrait;

class Category extends Model
{
    use NodeTrait;

    protected $table = 'advert_categories';

    public $timestamps = false;

    protected $fillable = ['name', 'slug', 'parent_id'];
}