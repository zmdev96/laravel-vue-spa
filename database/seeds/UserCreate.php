<?php

use Illuminate\Database\Seeder;
use App\Models\User;
use Carbon\Carbon;
class UserCreate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new User;
      $user->username = 'admin';
      $user->first_name = 'Admin';
      $user->last_name = 'Test';
      $user->email = 'admin@test.com';
      $user->password = bcrypt('password');
      $user->users_group_id = '1';
      $user->last_login = Carbon::now();
      $user->created_at = Carbon::now();
      $user->save();
    }
}
