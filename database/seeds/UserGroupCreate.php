<?php

use Illuminate\Database\Seeder;

use App\Models\UsersGroup;
use Carbon\Carbon;

class UserGroupCreate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new UsersGroup;
      $user->name = 'Superweisor';
      $user->created_at = Carbon::now();
      $user->save();
    }
}
