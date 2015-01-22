<?php namespace NpmWeb\MyAppName\Controllers\Backend;

use Auth;
use Input;
use Redirect;
use Request;
use Response;
use View;
use NpmWeb\LaravelBase\Controllers\BaseController;
use NpmWeb\MyAppName\Models\Organization;

class OrganizationsController extends BaseController {

    /**
     * Display a listing of organizations
     *
     * @return Response
     */
    public function index()
    {
        if( Request::wantsJson() ) {
            $organizations = Organization::all();
            return Response::json([
                'status' => 'success',
                'organizations' => $organizations->toArray(),
            ]);
        } else {
            return View::make('organizations.index');
        }
    }

    /**
     * Show the form for creating a new organization
     *
     * @return Response
     */
    public function create()
    {
        $id = Input::old('parent_organization_id');
        $id || $id = Input::get('parent');

        $organization = new Organization;
        $organization->parent_organization_id = $id;

        return View::make('organizations.edit',compact('organization'));
    }

    /**
     * Store a newly created organization in storage.
     *
     * @return Response
     */
    public function store()
    {
        $organization = new Organization(Input::all());
        $organization->save();

        if( $organization->errors()->any() )
        {
            return Redirect::back()->withErrors($organization->errors())->withInput();

        }

        return Redirect::route('organizations.index')
            ->with('myflash', 'Your organization has been created.');
    }

    /**
     * Display the specified organization.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $organization = Organization::findOrFail($id);

        return View::make('organizations.show',compact('organization'));
    }

    /**
     * Show the form for editing the specified organization.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $organization = Organization::findOrFail($id);

        return View::make('organizations.edit',compact('organization'));
    }

    /**
     * Update the specified organization in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $organization = Organization::findOrFail($id);
        $organization->update(Input::all());

        if( $organization->errors()->any() )
        {
            return Redirect::back()->withErrors($organization->errors())->withInput();

        }

        return Redirect::route('organizations.show', $id)
            ->with('myflash', 'Your organization has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Organization::destroy($id);

        return Redirect::route('organizations.index')
            ->with('myflash', 'Your organization has been deleted.');
    }

}
