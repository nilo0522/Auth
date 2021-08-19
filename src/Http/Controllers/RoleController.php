<?php

namespace Fligno\Auth\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Fligno\Auth\Traits\Paginators;
use Fligno\Auth\Resource\PaginationCollection;
use Laravel\Passport\Passport;
use Illuminate\Support\Carbon;
class RoleController extends Controller
{
   use Paginators;
  

    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::query();

        if (request('all')) {
            return response()->json($roles->get()->toArray());
        }

        $columns = ['name'];

        $data = $this->paginate($roles, $columns);
     
        return new PaginationCollection($data);
       
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //$this->setTokenExpire();  
        request()->validate([
            'name' => 'required|unique:roles',
        ]);

        $role = Role::create(request()->all());

        return response($role, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        return response($role, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
         
        request()->validate([
            'name' => 'required',
        ]);

        $role = Role::where('id',$id)->update(['name'=>$request->name]);

        return response()->json($role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }

    /**
     * Multiple Delete
     */
    public function destroyAll()
    {
          
        Role::whereIn('id', request('ids'))->delete();

        return response([], 204);
    }
}
