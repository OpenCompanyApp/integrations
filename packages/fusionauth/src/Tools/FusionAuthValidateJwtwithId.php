<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * validate JWTWith Id.
 *
 * Maps to GET /api/jwt/validate in the official FusionAuth OpenAPI document.
 */
class FusionAuthValidateJwtwithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_validate_jwtwith_id',
  'class' => 'FusionAuthValidateJwtwithId',
  'method' => 'GET',
  'path' => '/api/jwt/validate',
  'operation_id' => 'validateJWTWithId',
  'summary' => 'validate JWTWith Id',
  'description' => 'Validates the provided JWT (encoded JWT string) to ensure the token is valid. A valid access token is properly signed and not expired. This API may be used to verify the JWT as well as decode the encoded JWT into human readable identity claims.',
  'parameters' =>
  array (
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
