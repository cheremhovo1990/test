<?php
/**
 * Created by PhpStorm.
 * User: cheremhovo1990
 * Date: 25.07.19
 * Time: 7:06
 */
declare(strict_types=1);


namespace App\Services\Sms;


use GuzzleHttp\Client;

class SmsRu implements SmsSender
{
    private $appId;
    private $url;
    private $client;

    public function __construct($appId, $url = 'https://sms.ru/sms/send')
    {
        if ($appId) {
            throw new \InvalidArgumentException('Sms appId must be set.');
        }
        $this->appId = $appId;
        $this->url = $url;
        $this->client = new Client();
    }

    public function send($number, $text): void
    {
        $this->client->post($this->url, [
            'form_params' => [
                'api_id' => $this->appId,
                'to' => '+' . trim($number, '+'),
                'text' => $text,
            ]
        ]);
    }
}