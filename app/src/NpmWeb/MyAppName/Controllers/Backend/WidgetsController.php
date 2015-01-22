<?php namespace NpmWeb\MyAppName\Controllers\Backend;

use Input;
use Redirect;
use Request;
use Response;
use View;
use NpmWeb\LaravelBase\Controllers\BaseController;
use NpmWeb\MyAppName\Models\Widget;

class WidgetsController extends BaseController {

    /**
     * Display a listing of widgets
     *
     * @return Response
     */
    public function index()
    {
        if( Request::wantsJson() ) {
            $widgets = Widget::all();
            return Response::json([
                'status' => 'success',
                'widgets' => $widgets->toArray(),
            ]);
        } else {
            return View::make('widgets.index');
        }
    }

    /**
     * Show the form for creating a new widget
     *
     * @return Response
     */
    public function create()
    {
        $widget = new Widget;
        return View::make('widgets.edit',compact('widget'));
    }

    /**
     * Store a newly created widget in storage.
     *
     * @return Response
     */
    public function store()
    {
        $widget = new Widget(Input::all());
        $widget->save();

        if ($widget->errors()->any())
        {
            return Redirect::back()->withErrors($widget->errors())->withInput();
        }

        return Redirect::route('widgets.index')
            ->with('myflash', 'Your widget has been created.');
    }

    /**
     * Display the specified widget.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $widget = Widget::findOrFail($id);

        return View::make('widgets.show', compact('widget'));
    }

    /**
     * Show the form for editing the specified widget.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        $widget = Widget::findOrFail($id);

        return View::make('widgets.edit', compact('widget'));
    }

    /**
     * Update the specified widget in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id)
    {
        $widget = Widget::findOrFail($id);
        $widget->update(Input::all());

        if ($widget->errors()->any())
        {
            return Redirect::back()->withErrors($validator)->withInput();
        }

        return Redirect::route('widgets.index')
            ->with('myflash', 'Your widget has been updated.');
    }

    /**
     * Remove the specified widget from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Widget::destroy($id);

        return Redirect::route('widgets.index')
            ->with('myflash', 'Your widget has been deleted.');
    }

}
