<?php

use Illuminate\Database\Seeder;

use App\Models\SubCategory;
use Carbon\Carbon;

class CreateSubCategory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $cat = new SubCategory;
      $cat->name = 'Football';
      $cat->category_id = 1;
      $cat->created_at = Carbon::now();
      $cat->save();
    }
}
