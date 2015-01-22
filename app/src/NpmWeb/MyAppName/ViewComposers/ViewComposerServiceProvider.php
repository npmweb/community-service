<?php

namespace NpmWeb\MyAppName\ViewComposers;

class ViewComposerServiceProvider extends \Illuminate\Support\ServiceProvider {

    /**
     * Register the reference instance
     *
     * @return void
     */
    public function register()
    {
        $this->app->view->composer('*', 'NpmWeb\MyAppName\ViewComposers\GlobalViewComposer');
    }

}
