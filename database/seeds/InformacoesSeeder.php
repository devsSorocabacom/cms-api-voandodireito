<?php

use Illuminate\Database\Seeder;

class InformacoesSeeder extends Seeder
{
    public function run()
    {
        //factory(App\Info::class, 1)->create();
        $data = [
            ['id' => 1, 'email' => 'master@master.com', 'link_politica'=>'http://google.com']
        ];

        DB::table('infos')->insert($data);
    }
}
