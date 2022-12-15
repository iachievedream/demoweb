<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

/**
 * @OA\Info(
 *      version="1.0.0",
 *      title="電商網誌",
 *      description="接口文檔",
 *      @OA\Contact(
 *          email="iachievedream@gmail.com"
 *      ),
 *      @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *      )
 * ),
 * @OA\Get(
 *  path="/resources",
 *  summary="Get the list of resources",
 *  tags={"Resource"},
 *  @OA\Response(response=200, description="Return a list of resources"),
 *  security={{ "apiAuth": {} }}
 * )
 *
 */
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
}
