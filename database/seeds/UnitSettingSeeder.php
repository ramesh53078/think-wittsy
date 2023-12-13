<?php

use App\Admin\UnitSetting;
use Illuminate\Database\Seeder;

class UnitSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        UnitSetting::create([
            'sidebar_background' => 'dark',
            'panel_background' => 'dark-badge',
        ]);
    
    }
}
