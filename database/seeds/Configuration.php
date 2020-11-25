<?php

use Illuminate\Database\Seeder;
use App\Models\Configuration as config;

class Configuration extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            'logo' => 'logo.png',
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'address' => 'Company Address',
            'social_media_links' => '{"facebook":"facebook","twitter":"twitter","instagram":"instagram","youtube":"youtube","googleplus":"googleplus"}',
            'copyright' => '© Copyright 2019. All rights reserved.',
            'created_at' => null,
            'updated_at' => null,
            'contact_number' => '["+0123 567 123"]'
        ];

        config::insert($data);
    }
}
