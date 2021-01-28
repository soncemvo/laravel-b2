# B2-Backblaze Storage Adapter for Laravel 8

[![Latest Version on Packagist](https://img.shields.io/packagist/v/sundev/laravel-b2.svg?style=flat-square)](https://packagist.org/packages/sundev/laravel-b2)
[![Total Downloads](https://img.shields.io/packagist/dt/sundev/laravel-b2.svg?style=flat-square)](https://packagist.org/packages/sundev/laravel-b2)

Backblaze B2 is a cloud storage system comparable to Amazons S3. This adapter allows you to use B2 within Laravel 8 applications.

The code is based on [Paul Olthof](https://github.com/hpolthof)s [unmaintained repo](https://github.com/hpolthof/laravel-backblaze)

## Installation

Via Composer
```
composer require sundev/laravel-b2
```

In your app.php config file add to the list of service providers:
```
\sundev\Backblaze\BackblazeServiceProvider::class,
```

Add the following to your filesystems.php config file in the ```disks``` section:
```
'b2' => [
    'driver'         => 'b2',
    'accountId'      => '',
    'applicationKey' => '',
    'bucketName'     => '',
],
```

Now just paste in your credentials and bucketname and you're ready to go!


## Usage

Just use it as you normally would use the Storage facade.
```
Storage::disk('b2')->put('test.txt', 'test')
```
and
```
Storage::disk('b2')->get('test.txt')
```

## Credits

* [Paul Olthof](https://github.com/hpolthof)
* [Ramesh Mhetre](https://github.com/mhetreramesh/flysystem-backblaze)

## License

MIT, as the original repository.
