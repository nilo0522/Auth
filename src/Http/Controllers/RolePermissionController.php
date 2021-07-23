<?php

namespace Fligno\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Fligno\Auth\Traits\EventToken;
class RolePermissionController extends Controller
{
    use EventToken;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$this->setTokenExpire();  
        $roles = Role::with('permissions:id');
        return response()->json($roles->get()->toArray());
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Role $role, Permission $permission)
    {
       // $this->setTokenExpire();  
        $method = request('isChecked') ?  'givePermissionTo' : 'revokePermissionTo';

        $role->{$method}($permission);

        return response()->json($role);
    }
}
