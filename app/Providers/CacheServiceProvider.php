<?php

declare(strict_types=1);


namespace App\Providers;


use App\Entity\Region;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider;

class CacheServiceProvider extends AuthServiceProvider
{
    private $classes = [
        Region::class,
    ];

    public function boot(): void
    {
        foreach ($this->classes as $class) {
            $this->registerFlusher($class);
        }
    }

    public function registerFlusher($class)
    {
        $flush = function () use ($class) {
            \Cache::tags($class)->flush();
        };

        /** @var Model $class */
        $class::created($flush);
        $class::saved($flush);
        $class::updated($flush);
        $class::deleted($flush);
    }
}
