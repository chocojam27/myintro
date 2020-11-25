<?php

use Illuminate\Database\Seeder;
use App\Models\DefaultSetting as default_setting;

class DefaultSetting extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'avatar' => 'favicon.png',
            'cover' => 'bg.png',
            'created_at' => null,
            'updated_at' => null,
        ];

        default_setting::insert($data);
    }
}
