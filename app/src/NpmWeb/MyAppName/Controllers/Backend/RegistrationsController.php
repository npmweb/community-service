<?php

namespace NpmWeb\MyAppName\Controllers\Backend;

use Input;
use Redirect;
use View;
use NpmWeb\MyAppName\Models\Registration;
use NpmWeb\LaravelBase\Controllers\BaseController;

class RegistrationsController extends BaseController {

    protected $model;
    // protected $validator;

    public function __construct(Registration $model)
    {
        parent::__construct();
        $this->model = $model;
    }

    public function updateStatus() {
        $input = Input::all();
        $this->model->updateStatus($input['new_status']);
        // return Redirect::route('registrations.index')
        //  ->with('flash', 'Your status has been updated!');
        return View::make($this->modelName.'.statusUpdated',[
            'message'=>'Your record\'s status has been updated.']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $regs = $this->model->all();
        return View::make($this->modelName.'.index',['models'=>$regs]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return View::make($this->modelName.'.edit',['model'=>$this->model]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        $this->model->fill(Input::all());
        $obj->save();
        if( $obj->errors()->any() )
        {
            return Redirect::route($this->modelName.'.create')
                ->withInput()
                ->withErrors($this->reg->errors());
        }

        // $this->reg->create($input);

        return Redirect::route($this->modelName.'.index')
            ->with('myflash', 'Your record has been created.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $model = $this->model->findOrFail($id);
        return View::make($this->modelName.'.show',['model'=>$model]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $model = $this->model->findOrFail($id);
        return View::make($this->modelName.'.edit',['model'=>$model]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $model = $this->model->findOrFail($id);
        $model->fill(Input::all());
        $model->save();
        if( $model->errors()->any() )
        {
            return Redirect::route($this->modelName.'.edit',$id)
                ->withInput()
                ->withErrors($this->model->errors());
        }

        return Redirect::route($this->modelName.'.show', $id)
            ->with('myflash', 'Your record has been updated.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $model = $this->model->findOrFail($id);
        $model->delete();
        return Redirect::route($this->modelName.'.index')
            ->with('myflash', 'Your record has been deleted.');
    }

}
