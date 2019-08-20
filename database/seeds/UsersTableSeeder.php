<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        // 获取 Faker 实例
        $faker = app(Faker\Generator::class);

        // 头像假数据
        $avatars = [
            'http://dingyue.ws.126.net/15=9EUhfQyCeBJhGG3SFmAnmIu49kjZ04xYuTwcmI4u=K1553444607528.jpg',
            'http://dingyue.ws.126.net/e=cCUYs7IAZsGJEQTicVaHw8NpeCO4NEjfzA6S8YOelUI1553444607133.jpg',
            'http://dingyue.ws.126.net/X9Vf7=bh46tzgtjRww=1iNGPnxq8=pbXdresev11oOlc=1553444608104.jpg',
            'http://dingyue.ws.126.net/NdTnOc3jFo=3YzhrwbRj0HQlgbXIByICFxRrpxYNWTNPV1553444608915.jpg',
            'http://dingyue.ws.126.net/ekP90OPTkgyNVkzzwxTFS=rrK2AMqaxxz77oAj0wO2WsN1553444609781.jpg',
            'http://dingyue.ws.126.net/8yuuu9hpsJfzTkgvWn1VmfvGaEM2U2lmlkyUuaqsf9kDY1553444610272.jpg',
            'http://dingyue.ws.126.net/bTpMCnYLyeUisl9NLjBlLWpZWmEtMq3569O3dBAomGyHC1553444610764.jpg',
            'http://dingyue.ws.126.net/TfJ2GsgNtEhVtFHR=vFaYgeIIipSg7rZP3nRzbTag1CZj1553444611227.jpg',
            'http://dingyue.ws.126.net/AGlTlHnH4du6oEjbc2NenSWEEPSMsPmJpoT0cLIlEvdrO1553444612366.jpg',
            'http://dingyue.ws.126.net/McsNr7MZNuDfvNY2NT8Hc9B=1u3pducRLMzu7PFFNwjCf1553444612951.jpg',
            'http://dingyue.ws.126.net/wH1qt243jRWpx08OvIbUUXM=S1Bv54sIMJm0E6Na1NRUm1553444613404.jpg',
            'http://dingyue.ws.126.net/fuOkyHIqVsDIMnKzg0aES0pO=Lhapf3vDBwyBznK1MFu=1553444614083.jpg',
            'http://dingyue.ws.126.net/3mk=LfgwLTdUH95sRVaSOaJ9BeD4jT79oTccV3A4KnYqI1553444614487.jpg'
        ];

        // 生成数据集合
        $users = factory(User::class)
            ->times(10)
            ->make()
            ->each(function ($user, $index)
            use ($faker, $avatars)
            {
                // 从头像数组中随机取出一个并赋值
                $user->avatar = $faker->randomElement($avatars);
            });

        // 让隐藏字段可见，并将数据集合转换为数组
        $user_array = $users->makeVisible(['password', 'remember_token'])->toArray();

        // 插入到数据库中
        User::insert($user_array);

        // 单独处理第一个用户的数据
        $user = User::find(1);
        $user->name = 'rzl';
        $user->email = '1164373744@qq.com';
        $user->avatar = 'https://cdn.learnku.com/uploads/images/201710/14/1/ZqM7iaP4CR.png?imageView2/1/w/200/h/200';
        $user->save();
        // 初始化用户角色，将 1 号用户指派为『站长』
        $user->assignRole('Founder');

        // 将 2 号用户指派为『管理员』
        $user = User::find(2);
        $user->assignRole('Maintainer');

    }
}