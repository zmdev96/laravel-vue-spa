<?php

use Illuminate\Database\Seeder;
use App\Models\Member;
use Carbon\Carbon;
class MemberCreate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = new Member;
      $user->username = 'member_web';
      $user->first_name = 'Member';
      $user->last_name = 'Moslem';
      $user->email = 'member@test.com';
      $user->password = bcrypt('a123123a');
      $user->created_at = Carbon::now();
      $user->save();
    }
}
