<?php namespace NpmWeb\CommunityService\Services;

use Config;
use GrahamCampbell\Flysystem\Facades\Flysystem;
use NpmWeb\UploadHandler\FlysystemUploadHandler;
use NpmWeb\UploadHandler\IncrementingFileNameGenerator;

class FtpUploadHandlerServiceProvider
    extends \Illuminate\Support\ServiceProvider
{

    /**
     * Register the reference instance
     *
     * @return void
     */
    public function register() {
        $this->app->bindShared(
            'NpmWeb\\UploadHandler\\UploadHandlerInterface',
            function($app)
            {
                return $this->createUploadHandler($app);
            }
        );
    }

    protected function createUploadHandler( $app ) {
        return new FlysystemUploadHandler(
            $this->createFlysystem($app),
            $this->createFileNameGenerator($app)
        );
    }

    protected function createFlysystem($app) {
        return Flysystem::connection('cdn');
    }

    protected function createFileNameGenerator($app) {
        return new IncrementingFileNameGenerator;
    }

}
