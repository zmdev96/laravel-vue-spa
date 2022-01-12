<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(UserCreate::class);
         $this->call(MemberCreate::class);
         $this->call(UserGroupCreate::class);
         $this->call(UserProfileCreate::class);
         $this->call(Settings::class);
         $this->call(CreateCategory::class);
         $this->call(CreateSubCategory::class);


    }
}
