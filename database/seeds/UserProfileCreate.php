<?php

use Illuminate\Database\Seeder;

use App\Models\UsersProfile;
use Carbon\Carbon;

class UserProfileCreate extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new UsersProfile;
        $user->user_id = '1';
        $user->city = 'Gera';
        $user->address = 'hussstr.13';
        $user->phone = '0123456789';
        $user->birth_year = '1996-05-09';
        $user->about = 'WEb Developer';
        $user->image = 'images/users/RGwuUKoMPBAiMlvo8m6Fs6UjhmWHSH3KeoJD9fUg.jpeg';
        $user->save();
    }
}
