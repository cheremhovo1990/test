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

/**
 * Class Category
 * @package App\Entity\Adverts
 */
class Category extends Model
{
    use NodeTrait;

    /**
     * @var string
     */
    protected $table = 'advert_categories';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'slug', 'parent_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attributes()
    {
        return $this->hasMany(Attribute::class, 'category_id', 'id');
    }
}