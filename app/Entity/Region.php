<?php
/**
 * Created by PhpStorm.
 * User: cheremhovo1990
 * Date: 04.07.19
 * Time: 6:11
 */
declare(strict_types=1);


namespace App\Entity;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Region
 * @package App\Entity
 * @property $parent
 * @property $name
 */
class Region extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'slug', 'parent_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(static::class, 'parent_id', 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function children()
    {
        return $this->hasMany(static::class, 'parent_id', 'id');
    }
}