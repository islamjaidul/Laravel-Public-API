<?php

namespace Shared\Http\Responders;

use League\Fractal\Manager;
use League\Fractal\Resource\Item;
use Shared\Http\Action\BaseAction;
use League\Fractal\Resource\Collection;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

abstract class ApiResponder extends BaseAction
{
    protected $status = true;
    protected $paginatedData = [];
    protected $statusCode = 200;

    const CODE_FORBIDDEN = 'GEN-GTFO';
    const CODE_WRONG_ARGS = 'GEN-FUBARGS';
    const CODE_NOT_FOUND = 'GEN-LIKETHEWIND';
    const CODE_INTERNAL_ERROR = 'GEN-AAAGGH';
    const CODE_UNAUTHORIZED = 'GEN-MAYBGTFO';

    public function __construct(Manager $fractal)
    {
        $this->fractal = $fractal;
    }

    protected function getStatusCode()
    {
        return $this->statusCode;
    }

    protected function setStatusCode($statusCode)
    {
        $this->statusCode = $statusCode;
    }

    protected function setStatus($status)
    {
        $this->status = $status;
    }

    protected function respondWithItem(object $item, object $callback) 
    {
        $resource = new Item($item, $callback);
        $rootScope = $this->fractal->createData($resource);

        return $this->respond($rootScope->toArray()); 
    }

    protected function setPaginator($paginatedData)
    {
        $this->paginatedData = $paginatedData;
        return $this;
    }

    protected function respondWithCollection(array $collection, object $callback) : object
    {
        $resource = new Collection($collection, $callback);

        if (!empty($this->paginatedData)) {
            if (
                isset($this->paginatedData['total']) && 
                isset($this->paginatedData['perPage']) &&
                isset($this->paginatedData['currentPage'])
            ) {
                $paginator = new Paginator(
                    $collection, 
                    $this->paginatedData['total'], 
                    $this->paginatedData['perPage'], 
                    $this->paginatedData['currentPage']
                );
                $resource->setPaginator(new IlluminatePaginatorAdapter($paginator));    
            } else {
                throw new \Exception("Parameter is required, e.g. total, perPage, currentPage");
            }
        }
        
        $rootScope = $this->fractal->createData($resource);

        return $this->respond($rootScope->toArray());
    }

    protected function respond(array $array = [], array $headers = []) : object
    {
        $array = $array + ["status" => $this->status];

        return response()
        ->json($array, $this->statusCode, $headers);
    }

    protected function respondWithError($message, $errorCode)
    {
        if ($this->statusCode === 200) {
            trigger_error(
                "You better have a really good reason for erroring on a 200...",
                E_USER_WARNING
            );
        }
        return $this->respond([
            'error' => [
                'code' => $errorCode,
                'http_code' => $this->statusCode,
                'message' => $message,
            ]
        ]);
    }

    protected function errorForbidden($message = 'Forbidden')
    {
        return $this->setStatusCode(403)
          ->respondWithError($message, self::CODE_FORBIDDEN);
    }

    protected function errorInternalError($message = 'Internal Error')
    {
        return $this->setStatusCode(500)
          ->respondWithError($message, self::CODE_INTERNAL_ERROR);
    }

    protected function errorNotFound($message = 'Resource Not Found')
    {
        return $this->setStatusCode(404)
          ->respondWithError($message, self::CODE_NOT_FOUND);
    }

    protected function errorUnauthorized($message = 'Unauthorized')
    {
        return $this->setStatusCode(401)
          ->respondWithError($message, self::CODE_UNAUTHORIZED);
    }
    
    protected function errorWrongArgs($message = 'Wrong Arguments')
    {
        return $this->setStatusCode(400)
          ->respondWithError($message, self::CODE_WRONG_ARGS);
    }
    
}