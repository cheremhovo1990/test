<?php
/**
 * Created by PhpStorm.
 * User: cheremhovo1990
 * Date: 14.07.19
 * Time: 16:01
 */
declare(strict_types=1);


namespace App\Entity\Adverts;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Attribute
 * @package App\Entity\Adverts
 * @property $id
 * @property $category_id
 * @property $name
 * @property $type
 * @property $default
 * @property $required
 * @property $variants
 * @property $sort
 */
class Attribute extends Model
{
    /**
     *
     */
    public const TYPE_STRING = 'string';
    /**
     *
     */
    public const TYPE_INTEGER = 'integer';
    /**
     *
     */
    public const TYPE_FLOAT = 'float';

    /**
     * @var string
     */
    protected $table = 'advert_attributes';

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @var array
     */
    protected $fillable = ['name', 'type', 'required', 'default', 'variants', 'sort'];

    /**
     * @var array
     */
    protected $casts = [
        'variants' => 'array'
    ];

    /**
     * @return array
     */
    public static function typesList(): array
    {
        return [
            self::TYPE_STRING => 'String',
            self::TYPE_INTEGER => 'Integer',
            self::TYPE_FLOAT => 'Float'
        ];
    }

    /**
     * @return bool
     */
    public function isString(): bool
    {
        return $this->type == self::TYPE_STRING;
    }

    /**
     * @return bool
     */
    public function isInteger(): bool
    {
        return $this->type == self::TYPE_INTEGER;
    }

    /**
     * @return bool
     */
    public function isFloat(): bool
    {
        return $this->type == self::TYPE_FLOAT;
    }

    /**
     * @return bool
     */
    public function isSelect(): bool
    {
        return count($this->variants) > 0;
    }
}