<?php

namespace sundev\B2;

use Psr\Http\Message\ResponseInterface;
use sundev\B2\Exceptions\B2Exception;
use sundev\B2\Exceptions\BadJsonException;
use sundev\B2\Exceptions\BadValueException;
use sundev\B2\Exceptions\BucketAlreadyExistsException;
use sundev\B2\Exceptions\BucketNotEmptyException;
use sundev\B2\Exceptions\FileNotPresentException;
use sundev\B2\Exceptions\NotFoundException;


class ErrorHandler
{
    protected static $mappings = [
        'bad_json'                       => BadJsonException::class,
        'bad_value'                      => BadValueException::class,
        'duplicate_bucket_name'          => BucketAlreadyExistsException::class,
        'not_found'                      => NotFoundException::class,
        'file_not_present'               => FileNotPresentException::class,
        'cannot_delete_non_empty_bucket' => BucketNotEmptyException::class,
    ];

    public static function handleErrorResponse(ResponseInterface $response)
    {
        $responseJson = json_decode($response->getBody(), true);

        if (isset(self::$mappings[$responseJson['code']])) {
            $exceptionClass = self::$mappings[$responseJson['code']];
        } else {
            // We don't have an exception mapped to this response error, throw generic exception
            $exceptionClass = B2Exception::class;
        }

        throw new $exceptionClass(sprintf('Received error from B2: %s. Code: %s', $responseJson['message'], $responseJson['code']));
    }
}
