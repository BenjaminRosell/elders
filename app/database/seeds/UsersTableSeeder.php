<?php

class UsersTableSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = array(
           
           array(
            'id' => 1,
            'email' => 'user@elders.com',
            'username' => 'notassigned',
            'password' => '$2y$10$xiSDuLYRAN5ujKCp2uSNauxUA1Nt3WP1Wa.Emg6dfqkRWyPCnoGh.',
            'activated' => '1',
            'first_name' => 'Not',
            'last_name' => 'Assigned',
            'phone' => '5142361889',
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
            ),

           array(
            'id' => 2,
            'email' => 'admin@elders.com',
            'username' => 'admin',
            'password' => '$2y$10$xiSDuLYRAN5ujKCp2uSNauxUA1Nt3WP1Wa.Emg6dfqkRWyPCnoGh.',
            'activated' => '1',
            'first_name' => 'Administrator',
            'last_name' => 'by Default',
            'phone' => '5142361889',
            'created_at' => new DateTime,
            'updated_at' => new DateTime,
            ),

        );

        DB::table('users')->insert($items);
    }

}