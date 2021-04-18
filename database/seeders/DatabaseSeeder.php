<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Repositories\Repository;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.

     * @return void
     */


    public function run()
    {
        // \App\Models\User::factory(10)->create();
        touch('database/database.sqlite');
        $repository = new Repository();
        $repository->createDatabase();
        $repository->premierRemplissage();
        /*
        $repository->addUser('user@email.fr', 'secret', 0);
        */
        $repository->addUser('admin@email.fr', 'secret', 2);
    }
}
