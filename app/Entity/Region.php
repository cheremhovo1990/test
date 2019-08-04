<?php
/**
 * Created by PhpStorm.
 * User: cheremhovo1990
 * Date: 04.07.19
 * Time: 6:11
 */
declare(strict_types=1);


namespace App\Entity;


use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Region
 * @package App\Entity
 * @property Region $parent
 * @property $name
 *
 * @method Builder roots()
 */
class Region extends Model
{
    /**
     * @var array
     */
    protected $fillable = ['name', 'slug', 'parent_id'];

    public function getAddress(): string
    {
        return ($this->parent ? $this->parent->getAddress() . ', ' : '') . $this->name;
    }

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

    public function scopeRoots(Builder $query)
    {
        return $query->where('parent_id', null);
    }
}
