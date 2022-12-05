<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Job;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'john Doe',
            'email' => 'john@gmail.com'
        ]);

        // factory for jobs tbl
        Job::factory(7)->create([
            'user_id' => $user->id
        ]);
        
        /**
         * Note: factory name have to be simple and readable
        */

        // Job::create([
        //     "title" => "Node.js senior developer",
        //     "tags" => "Express, Javascript",
        //     "company" => "Harjo Tech",
        //     "location" => "Abuja. Nigeria",
        //     "email" => "harjotech@gmail.com",
        //     "website" => "https://www.harjotech.com",
        //     "description" => "
        //          Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas cupiditate earum nam
        //         dicta maiores, unde saepe perferendis! Ex, rem harum."
        // ]);

        // Job::create([
        //     "title" => "Frontend Developer",
        //     "tags" => "Javascript, React, Sass, Bootstrap",
        //     "company" => "MarkUp Tech",
        //     "location" => "Markudi. Nigeria",
        //     "email" => "markuptech@gmail.com",
        //     "website" => "https://www.markuptech.com",
        //     "description" => "
        //          Lorem ipsum dolor sit amet consectetur adipisicing elit. Voluptas cupiditate earum nam
        //         dicta maiores, unde saepe perferendis! Ex, rem harum."
        // ]);
    }
}
