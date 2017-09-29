<?php

use Illuminate\Database\Seeder;
use App\LibrarySetting;
class LibrarySettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $setting = new LibrarySetting();
        $setting->biaya_denda = 300;
        $setting->maksimal_hari = 14;
        $setting->save();
    }
}
