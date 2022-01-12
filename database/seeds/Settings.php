<?php

use Illuminate\Database\Seeder;
use App\Models\Setting;
use Carbon\Carbon;
class Settings extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $setting = new Setting;
      $setting->name = 'blog';
      $setting->email = 'blog@info.com';
      $setting->logo = 'settings\hnqmBPCMT7ncRhPYSoHz50cCUgbpSmpbHuK5ETzw.png';
      $setting->icon = 'settings\hnqmBPCMT7ncRhPYSoHz50cCUgbpSmpbHuK5ETzw.png';
      $setting->desc = 'our new blog';
      $setting->created_at = Carbon::now();
      $setting->save();
    }
}
