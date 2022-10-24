<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *     title="Laravel Swagger API documentation",
 *     version="1.0.0",
 *     @OA\Contact(
 *         email="vahagn99ghukasyan@gmail.com"
 *     ),
 *     @OA\License(
 *         name="Apache 2.0",
 *         url="http://www.apache.org/licenses/LICENSE-2.0.html"
 *     )
 * )
 * @OA\Tag(
 *     name="Cars",
 *     description="Car CRUD",
 * )
 * @OA\Tag(
 *     name="Rent car",
 *     description="Rent car functionality",
 * )
 */
class ApiController extends Controller
{

}
