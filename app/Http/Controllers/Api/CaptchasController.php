<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Gregwar\Captcha\CaptchaBuilder;
use App\Http\Requests\Api\CaptchaRequest;

class CaptchasController extends Controller
{
    public function store(CaptchaRequest $request, CaptchaBuilder $captchaBuilder)
    {
        $key = 'captcha-'.str_random(15);
        $phone = $request->phone;

        $captcha = $captchaBuilder->build();
        $expiredAt = now()->addMinutes(2);
        \Cache::put($key, ['phone' => $phone, 'code' => $captcha->getPhrase()], $expiredAt);

        $result = [
            'captcha_key' => $key,
            'expired_at' => $expiredAt->toDateTimeString(),
            'captcha_image_content' => $captcha->inline()
        ];

        return $this->response->array($result)->setStatusCode(201);
    }

    public function show(Request $request,CaptchaBuilder $captchaBuilder)
    {
        $captchaData = \Cache::get($request->captcha_key);

        if (!$captchaData) {
            return [
                'message' => '没有图片验证码，请重试',
                'code' => '404'
            ];
        }

        $captchaBuilder->build();
        header('Content-type: image/jpeg');
        $captchaBuilder->output();
    }
}
