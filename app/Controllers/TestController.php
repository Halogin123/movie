<?php

namespace MovieChill\app\Controllers;

use App\Http\Controllers\Controller;

class TestController extends Controller
{
    public function index()
    {
        $mail = 'Demo-1_2.3+value@pm.me';

        $domainMail = strtolower(preg_replace('/^.*@/', '', $mail));
        $localPart = strtolower(preg_replace('/@.*$/', '', $mail));

        if (filter_var($mail , FILTER_VALIDATE_EMAIL)) {
            $cleanMail = match ($domainMail) {
                'gmail.com', 'googlemail.com' => explode('+', str_replace('.', '', $localPart))[0] . '@gmail.com',
                'yandex.com' => str_replace(['.', '-'], '', $localPart) . '@' . $domainMail,
                'protonmail.com', 'proton.me', 'protonmail.ch', 'pm.me' => str_replace(['.', '_', '-'], '', $localPart) . '@protonmail.com',
                default => strtolower($mail),
            };
            return $cleanMail;
        }

        return $mail;
    }
}
