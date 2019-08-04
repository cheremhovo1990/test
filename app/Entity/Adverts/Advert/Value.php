<?php

declare(strict_types=1);


namespace App\Entity\Adverts\Advert;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Value
 * @package App\Entity\Adverts\Advert
 * @property $attribute_id
 * @property $value
 */
class Value extends Model
{
    protected $table = 'advert_advert_values';

    public $timestamps = false;

    protected $fillable = ['attribute_id', 'value'];
}
