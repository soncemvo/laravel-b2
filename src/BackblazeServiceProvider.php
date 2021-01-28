<?php

namespace sundev\Backblaze;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\ServiceProvider;
use League\Flysystem\Filesystem;
use sundev\B2\Client;

class BackblazeServiceProvider extends ServiceProvider
{
    /**
     * @return \League\Flysystem\Filesystem
     */
    public function boot()
    {
        Storage::extend('b2', function ($app, $config) {
            // check if all required configuration keys are given.
            if (
                !isset($config['accountId']) ||
                !isset($config['applicationKey']) ||
                !isset($config['bucketName'])
            ) {
                throw new BackblazeException('Please set the "accountId", "applicationKey" and "bucketName" configuration keys.');
            }

            // create a client
            $client = new Client($config['accountId'], array('applicationKey' => $config['applicationKey']));

            // create an new adapter
            $adapter = new BackblazeAdapter($client, $config['bucketName']);

            // and return the file system.
            return new Filesystem($adapter);
        });
    }

    /**
     * @return void
     */
    public function register()
    {
    }
}
