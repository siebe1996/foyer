<?php

namespace App\Annotations;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/sanctum/csrf-cookie",
 *     summary="Get CSRF cookie",
 *     tags={"Authentication"},
 *     @OA\Response(
 *         response=204,
 *         description="CSRF cookie retrieved successfully"
 *     )
 * )
 */
class CsrfAnnotations
{
    // Empty class, used only for Swagger annotations
}
