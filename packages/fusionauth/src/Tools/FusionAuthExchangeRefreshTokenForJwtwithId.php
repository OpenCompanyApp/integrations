<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * exchange Refresh Token For JWTWith Id.
 *
 * Maps to POST /api/jwt/refresh in the official FusionAuth OpenAPI document.
 */
class FusionAuthExchangeRefreshTokenForJwtwithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_exchange_refresh_token_for_jwtwith_id',
  'class' => 'FusionAuthExchangeRefreshTokenForJwtwithId',
  'method' => 'POST',
  'path' => '/api/jwt/refresh',
  'operation_id' => 'exchangeRefreshTokenForJWTWithId',
  'summary' => 'exchange Refresh Token For JWTWith Id',
  'description' => 'Exchange a refresh token for a new JWT.',
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
