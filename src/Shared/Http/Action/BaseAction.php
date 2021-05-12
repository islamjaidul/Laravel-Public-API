<?php

namespace Shared\Http\Action;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as Action;

class BaseAction extends Action
{
	/**
     * @OA\Info(
     *      version="3.0.0",
     *      title="API Documentation",
     *      description="Swagger OpenApi description",
     *      @OA\Contact(
     *          email="jaidul26@gmail.com"
     *      ),
     *      @OA\License(
     *          name="Apache 2.0",
     *          url="http://www.apache.org/licenses/LICENSE-2.0.html"
     *      )
     * )
     *
     * @OA\Server(
     *      url=L5_SWAGGER_CONST_HOST,
     *      description="API Server"
     * )

     *
     * @OA\Tag(
     *     name="Backend",
     *     description="API Endpoints of Backend"
     * )
     */
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
