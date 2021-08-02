<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

class RoleTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_admin_role(){
        // find the admin model
        $user = User::query()->find(1);
        $this->assertTrue($user->hasRole('Admin'));
    }

    public function test_user_role(){
        // find the user model
        $user = User::query()->find(2);
        $this->assertTrue($user->hasRole('User'));
    }


    public function test_has_roles(){
        // test to see if there are two roles only
        $roles = Role::all();
        $this->assertEquals(2, count($roles));
    }

    public function Ttest_admin_has_permissions(){
        $role = Role::findByName('Admin');
        $this->assertTrue($role->hasPermissionTo('add'));
        $this->assertTrue($role->hasPermissionTo('edit'));
        $this->assertTrue($role->hasPermissionTo('delete'));
    }

    public function test_user_has_permissions(){
        $role = Role::findByName('User');
        $this->assertFalse($role->hasPermissionTo('add'));
        $this->assertTrue($role->hasPermissionTo('edit'));
        $this->assertFalse($role->hasPermissionTo('delete'));
    }


}
