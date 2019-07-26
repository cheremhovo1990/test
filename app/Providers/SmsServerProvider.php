<?php

declare(strict_types=1);


namespace App\Providers;


use App\Services\Sms\ArraySender;
use App\Services\Sms\SmsRu;
use App\Services\Sms\SmsSender;
use Illuminate\Foundation\Application;
use Illuminate\Support\ServiceProvider;

class SmsServerProvider extends ServiceProvider
{
    public function register()
    {
        $this->app->singleton(SmsSender::class, function (Application $app) {
            $config = $app->make('config')->get('sms');

            switch ($config['driver']) {
                case 'sms.ru':
                    $params = $config['divers']['sms.ru'];
                    if (!empty($params['url'])) {
                        return new SmsRu($params['app_id'], $params['url']);
                    }
                case 'array':
                    return new ArraySender();
                default:
                    throw new \InvalidArgumentException('Undefined SMS driver ' . $config['driver']);
            }
        });
    }
}
