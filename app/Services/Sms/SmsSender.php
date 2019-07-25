<?php
/**
 * Created by PhpStorm.
 * User: cheremhovo1990
 * Date: 25.07.19
 * Time: 7:04
 */

namespace App\Services\Sms;


interface SmsSender
{
    public function send($number, $text): void;
}