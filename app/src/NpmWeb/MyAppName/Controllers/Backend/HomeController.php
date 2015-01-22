<?php

namespace NpmWeb\MyAppName\Controllers\Backend;

use App;
use Config;
use Reference;
use View;
use NpmWeb\MiddlewareClient\Chms\ChmsClientGroup;
use NpmWeb\LaravelBase\Controllers\BaseController;

class HomeController extends BaseController {

    protected $chms;

    public function __construct( ChmsClientGroup $chms ) {
        parent::__construct();
        $this->chms = $chms;
    }

    public function index()
    {
        return View::make('home.index');
    }

    public function dataSources()
    {
        return View::make('home.dataSources',[
            'environment' => App::environment(),
            'myconfigString' => Config::get('myconfig.string'),
            'myconfigInherited' => Config::get('myconfig.inherited'),
            'myconfigArray' => Config::get('myconfig.array'),
            'reference' => Reference::get('marital-statuses'),
            'middleware' => $this->chms->people->getPerson(16029),
        ]);
    }

}