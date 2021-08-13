<?php

namespace Fligno\Auth\Http\Controllers;

use Illuminate\Http\Request;
use Fligno\Auth\Models\Organization;
use Fligno\Auth\Traits\Paginators;
use Fligno\Auth\Resource\PaginationCollection;
class OrganizationController extends Controller
{
    use Paginators;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organization = Organization::query();

        if (request('all')) {
            return response()->json($organization->get()->toArray());
        }

        $columns = ['company','email'];

        $data = $this->paginate($organization, $columns);

        return new PaginationCollection($data);
    }

    /**
     * Show the form for creating a new resource.
     *S
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'company' => 'required|string',
            'email' => 'required|string|email|unique:organizations',
            'contact' => 'required|string|',
            'address' => 'required|string|'

            
        ]);
         $organization = Organization::create(request()->all());

        return response()->json("ok");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         return response()->json(Organization::find($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'company' => 'required|string',
            'email' => 'required|string|email|unique:organizations,email,'.$id,
            'contact' => 'required|string|',
            'address' => 'required|string|'

            
        ]);
        $organization = Organization::find($id);
        $organization ->fill($request->all())->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function destroyAll()
    {
       // $this->setTokenExpire();  
        Organization::whereIn('id', request('ids'))->delete();

        return response([], 204);
    }
}
