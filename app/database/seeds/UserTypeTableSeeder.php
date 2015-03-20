<?php

use NpmWeb\MultilevelOrganizations\Models\UserType;

class UserTypeTableSeeder extends Seeder {

    public function run()
    {
        DB::table('user_types')->delete();

        UserType::create([
            'id' => 1,
            'name' => 'Site Administrator',
            'level' => UserType::SITE_ADMIN_LEVEL,
        ]);
        UserType::create([
            'id' => 2,
            'name' => 'Church Administrator',
            'level' => UserType::ORG_ADMIN_LEVEL,
        ]);
        UserType::create([
            'id' => 3,
            'name' => 'Church User',
            'level' => UserType::ORG_USER_LEVEL,
        ]);
    }

}
