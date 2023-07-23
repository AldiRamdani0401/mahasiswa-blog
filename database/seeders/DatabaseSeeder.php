<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
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

        User::create([
            'name' => 'Aldi Ramdani',
            'username' => 'aldiramdani',
            'email' => 'aldi@gmail.com',
            'password' => bcrypt('password')
        ]);

        // User::create([
        //     'name' => 'Budi Santoso',
        //     'email' => 'budi@gmail.com',
        //     'password' => bcrypt('password')
        // ]);

        User::factory(3)->create();

        Category::create([
            'name' => 'Web Programming',
            'slug' => 'web-programming'
        ]);

        Category::create([
            'name' => 'Web Design',
            'slug' => 'web-design'
        ]);

        Category::create([
            'name' => 'Personal',
            'slug' => 'personal'
        ]);

        Post::factory(20)->create();

        // Post::create([
        //     'title' => 'Judul Pertama',
        //     'slug' => 'judul-pertama',
        //     'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        //     'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, quia ut repellat laborum non cumque necessitatibus nulla qui perferendis quam voluptatum possimus quod cupiditate illo voluptates architecto, error deleniti dolor? Et architecto fugit nulla dignissimos eos harum tenetur obcaecati illo eius quae doloremque dolorum, labore aliquam nisi exercitationem repudiandae, non perspiciatis magni suscipit officia, commodi consectetur voluptas facere. Excepturi, officia deserunt. In numquam aspernatur quis magni quam doloremque repudiandae, earum quae, deleniti laudantium, possimus iusto pariatur corrupti ipsa facere. Perspiciatis error et saepe maiores, unde perferendis nobis deleniti ratione! Temporibus doloremque ex corporis consectetur quidem minima officiis explicabo provident quos.',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Kedua',
        //     'slug' => 'judul-kedua',
        //     'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        //     'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, quia ut repellat laborum non cumque necessitatibus nulla qui perferendis quam voluptatum possimus quod cupiditate illo voluptates architecto, error deleniti dolor? Et architecto fugit nulla dignissimos eos harum tenetur obcaecati illo eius quae doloremque dolorum, labore aliquam nisi exercitationem repudiandae, non perspiciatis magni suscipit officia, commodi consectetur voluptas facere. Excepturi, officia deserunt. In numquam aspernatur quis magni quam doloremque repudiandae, earum quae, deleniti laudantium, possimus iusto pariatur corrupti ipsa facere. Perspiciatis error et saepe maiores, unde perferendis nobis deleniti ratione! Temporibus doloremque ex corporis consectetur quidem minima officiis explicabo provident quos.',
        //     'category_id' => 1,
        //     'user_id' => 1
        // ]);

        // Post::create([
        //     'title' => 'Judul Ketiga',
        //     'slug' => 'judul-ketiga',
        //     'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        //     'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, quia ut repellat laborum non cumque necessitatibus nulla qui perferendis quam voluptatum possimus quod cupiditate illo voluptates architecto, error deleniti dolor? Et architecto fugit nulla dignissimos eos harum tenetur obcaecati illo eius quae doloremque dolorum, labore aliquam nisi exercitationem repudiandae, non perspiciatis magni suscipit officia, commodi consectetur voluptas facere. Excepturi, officia deserunt. In numquam aspernatur quis magni quam doloremque repudiandae, earum quae, deleniti laudantium, possimus iusto pariatur corrupti ipsa facere. Perspiciatis error et saepe maiores, unde perferendis nobis deleniti ratione! Temporibus doloremque ex corporis consectetur quidem minima officiis explicabo provident quos.',
        //     'category_id' => 2,
        //     'user_id' => 2
        // ]);

        // Post::create([
        //     'title' => 'Judul Keempat',
        //     'slug' => 'judul-keempat',
        //     'excerpt' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit.',
        //     'body' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Esse, quia ut repellat laborum non cumque necessitatibus nulla qui perferendis quam voluptatum possimus quod cupiditate illo voluptates architecto, error deleniti dolor? Et architecto fugit nulla dignissimos eos harum tenetur obcaecati illo eius quae doloremque dolorum, labore aliquam nisi exercitationem repudiandae, non perspiciatis magni suscipit officia, commodi consectetur voluptas facere. Excepturi, officia deserunt. In numquam aspernatur quis magni quam doloremque repudiandae, earum quae, deleniti laudantium, possimus iusto pariatur corrupti ipsa facere. Perspiciatis error et saepe maiores, unde perferendis nobis deleniti ratione! Temporibus doloremque ex corporis consectetur quidem minima officiis explicabo provident quos.',
        //     'category_id' => 2,
        //     'user_id' => 2
        // ]);
    }
}
