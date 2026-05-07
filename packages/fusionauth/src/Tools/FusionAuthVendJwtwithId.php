<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * vend JWTWith Id.
 *
 * Maps to POST /api/jwt/vend in the official FusionAuth OpenAPI document.
 */
class FusionAuthVendJwtwithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_vend_jwtwith_id',
  'class' => 'FusionAuthVendJwtwithId',
  'method' => 'POST',
  'path' => '/api/jwt/vend',
  'operation_id' => 'vendJWTWithId',
  'summary' => 'vend JWTWith Id',
  'description' => 'It\'s a JWT vending machine! Issue a new access token (JWT) with the provided claims in the request. This JWT is not scoped to a tenant or user, it is a free form token that will contain what claims you provide. The iat, exp and jti claims will be added by FusionAuth, all other claims must be provided by the caller. If a TTL is not provided in the request, the TTL will be retrieved from the default Tenant or the Tenant specified on the request either by way of the X-FusionAuth-TenantId request he',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
    ),
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
  'content_type' => 'application/json',
  'type' => 'write',
);
}
