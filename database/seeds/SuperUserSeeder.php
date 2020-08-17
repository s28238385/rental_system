<?php
use App\User;
use Illuminate\Database\Seeder;

class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => '$2y$10$MOq8l6mT8oTkMBq36vsvredfzqCzQJw3KUuYazky7NhMlDPp9ezum',
            'role' => '管理員'
        ]);
        $user->save();
    }
}
