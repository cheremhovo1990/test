<?php

declare(strict_types=1);


namespace App\Entity\Adverts\Advert;


use Illuminate\Database\Eloquent\Model;

/**
 * Class Photo
 * @package App\Entity\Adverts\Advert
 * @property $id
 * @property $file
 */
class Photo extends Model
{
    protected $table = 'advert_advert_photos';

    public $timestamps = false;

    protected $fillable = ['file'];
}
