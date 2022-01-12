<?php

use Illuminate\Database\Seeder;

use App\Models\Category;
use Carbon\Carbon;

class CreateCategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $cat = new Category;
      $cat->name = 'Sport';
      $cat->created_at = Carbon::now();
      $cat->save();
    }
}
