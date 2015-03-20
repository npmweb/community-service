<?php

use NpmWeb\MultilevelOrganizations\Models\User;

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('users')->delete();

        $user = new User();
        $user->fill([
            // no organization id
            'user_type_id' => 1,
            'username' => 'superadmin',
            'password' => 'password',
            'password_confirmation' => 'password',
            'display_name' => 'NPM Admin',
            'email' => 'siteadmin@domain.org',
        ]);
        $result = $user->save();
        // echo var_dump($result);
        // print_r($user->errors()->all());
        // echo 'hi';exit;
        // var_dump(DB::getQueryLog());
        $user = new User();
        $user->fill([
            'organization_id' => 1,
            'user_type_id' => 2,
            'username' => 'churchadmin',
            'password' => 'password',
            'password_confirmation' => 'password',
            'display_name' => 'Church Admin',
            'email' => 'churchadmin@domain.org',
        ]);
        $result = $user->save();
        // echo var_dump($result);
        // print_r($user->errors()->all());
        // echo 'hi';exit;
        // var_dump(DB::getQueryLog());
        $user = new User();
        $user->fill([
            'organization_id' => 2,
            'user_type_id' => 3,
            'username' => 'churchuser',
            'password' => 'password',
            'password_confirmation' => 'password',
            'display_name' => 'Church User',
            'email' => 'churchuser@domain.org',
        ]);
        $result = $user->save();
        $user = new User();
        $user->fill([
            'organization_id' => 1,
            'user_type_id' => 3,
            'username' => 'parentuser',
            'password' => 'password',
            'password_confirmation' => 'password',
            'display_name' => 'Parent User',
            'email' => 'churchuser@domain.org',
        ]);
        $result = $user->save();

        $user = new User();
        $user->fill([
            'organization_id' => 3,
            'user_type_id' => 3,
            'username' => 'thirduser',
            'password' => 'password',
            'password_confirmation' => 'password',
            'display_name' => 'Third User',
            'email' => 'thirduser@domain.org',
        ]);
        $result = $user->save();
    }

}
