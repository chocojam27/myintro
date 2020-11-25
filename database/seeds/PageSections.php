<?php

use App\Models\Page\PageSection;
use Illuminate\Database\Seeder;

class PageSections extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [];
        $sections = [
            0 => 'SEO',
            1 => 'First',
            2 => 'Second',
            3 => 'Third',
            4 => 'Fourth',
            5 => 'Fifth',
            6 => 'Sixth',
            7 => 'Seventh',
            8 => 'Eight',
            9 => 'Ninth',
            10 => 'Tenth',
            11 => 'Eleventh',
            12 => 'Twelveth'
        ];
        for ($i = 0; $i <= 12 ; $i++) {
            array_push($data, [
                'name' => $sections[$i],
            ]);
        }

        PageSection::insert($data);
    }
}
