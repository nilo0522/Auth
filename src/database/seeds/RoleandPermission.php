<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use Fligno\Auth\Models\Newsletter;
use Fligno\Auth\Models\EmailContent;
use Fligno\Auth\Models\Post;
class RoleandPermisssion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        Permission::create(['name' => 'add']);
        Permission::create(['name' => 'edit']);
        Permission::create(['name' => 'delete']);

        // create roles and assign created permissions

        // this can be done as separate statements
        $role = Role::create(['name' => 'User', 'guard_name' => 'api']);
        $role->givePermissionTo('edit');


        $role = Role::create(['name' => 'Admin', 'guard_name' => 'api']);
        $role->givePermissionTo(Permission::all());

        $user = User::create([
            'name' => 'Admin Fligno',
            'email' => 'admin@fligno.com',
            'password' => bcrypt('Default123')
        ]);

        $user->assignRole('Admin');
        Newsletter::create(['email'=>'admin@fligno.com']);
        EmailContent::create(['subject'=>'TEST','content' => 'THIS IS A SAMPLE EMAIL']);
        Post::create(['title'=> 'My Post','content' => 'My Content']);

    }
}
