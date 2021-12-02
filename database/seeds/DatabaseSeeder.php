<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //MOVIES
        DB::table('movies')->insert([
            'name' => 'Guardians of the Galaxy',
            'year_realase' => 2014,
            'movie_length' => 121,
            'actors' => 'Chris Pratt, Vin Diesel, Bradley Cooper',
            'director' => 'James Gunn',
            'imbd' => 8.0,
            'description' => 'A group of intergalactic criminals must pull together to stop a fanatical warrior with plans to purge the universe.',
            'picture_url' => 'https://droidjournal.com/wp-content/uploads/2020/04/guardians-of-the-galaxy-2-poster.jpg',
            'trailer_url' => 'https://www.youtube.com/watch?v=d96cjJhvlMA',
        ]);
        DB::table('movies')->insert([
            'name' => 'Venom',
            'year_realase' => 2016,
            'movie_length' => 112,
            'actors' => 'Tom Hardy, Michelle Williams, Riz Ahmed',
            'director' => 'Ruben Fleischer',
            'imbd' => 6.7,
            'description' => 'A failed reporter is bonded to an alien entity, one of many symbiotes who have invaded Earth. But the being takes a liking to Earth and decides to protect it.',
            'picture_url' => 'https://m.media-amazon.com/images/M/MV5BNzAwNzUzNjY4MV5BMl5BanBnXkFtZTgwMTQ5MzM0NjM@._V1_FMjpg_UX1000_.jpg',
            'trailer_url' => 'https://www.youtube.com/watch?v=u9Mv98Gr5pY',
        ]);
        DB::table('movies')->insert([
            'name' => 'Deadpool',
            'year_realase' => 2016,
            'movie_length' => 108,
            'actors' => ' Ryan Reynolds, Morena Baccarin, T.J. Miller',
            'director' => 'Tim Miller',
            'imbd' => 8.0,
            'description' => 'A wisecracking mercenary gets experimented on and becomes immortal but ugly, and sets out to track down the man who ruined his looks.',
            'picture_url' => 'https://i2.wp.com/www.tehix.hr/wp-content/uploads/2019/12/Ryan-Reynolds-potvrdio-Deadpool-3-TEHIX2.jpg',
            'trailer_url' => 'https://www.youtube.com/watch?v=ONHBaC-pfsk',
        ]);
        //---------------------------------------------------------
        //USERS
        DB::table('users')->insert([
            'name' => 'user1',
            'email' => 'user1@email.com',
            'password' => bcrypt('user1'),
        ]);
        DB::table('users')->insert([
            'name' => 'user2',
            'email' => 'user2@email.com',
            'password' => bcrypt('user2'),
        ]);
        DB::table('users')->insert([
            'name' => 'user3',
            'email' => 'user3@email.com',
            'password' => bcrypt('user3'),
        ]);
        DB::table('users')->insert([
            'name' => 'user4',
            'email' => 'user4@email.com',
            'password' => bcrypt('user4'),
        ]);
        DB::table('users')->insert([
            'name' => 'admin1',
            'email' => 'admin1@email.com',
            'password' => bcrypt('admin1'),
        ]);
        DB::table('users')->insert([
            'name' => 'admin2',
            'email' => 'admin2@email.com',
            'password' => bcrypt('admin2'),
        ]);
        //---------------------------------------------------------
        //ROLES
        DB::table('roles')->insert([
            'name' => 'user',
        ]);
        DB::table('roles')->insert([
            'name' => 'admin',
        ]);
        //---------------------------------------------------------
        //AUTHORITIES
        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 1,
        ]);
        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 2,
        ]);
        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 3,
        ]);
        DB::table('role_user')->insert([
            'role_id' => 1,
            'user_id' => 4,
        ]);
        DB::table('role_user')->insert([
            'role_id' => 2,
            'user_id' => 5,
        ]);
        DB::table('role_user')->insert([
            'role_id' => 2,
            'user_id' => 6,
        ]);
    }
}
