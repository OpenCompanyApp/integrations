<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Refresh Token By Id With Id.
 *
 * Maps to GET /api/jwt/refresh/{tokenId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveRefreshTokenByIdWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_refresh_token_by_id_with_id',
  'class' => 'FusionAuthRetrieveRefreshTokenByIdWithId',
  'method' => 'GET',
  'path' => '/api/jwt/refresh/{tokenId}',
  'operation_id' => 'retrieveRefreshTokenByIdWithId',
  'summary' => 'retrieve Refresh Token By Id With Id',
  'description' => 'Retrieves a single refresh token by unique Id. This is not the same thing as the string value of the refresh token. If you have that, you already have what you need.',
  'parameters' =>
  array (
    'token_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the token.',
    ),
  ),
  'path_params' =>
  array (
    'tokenId' => 'token_id',
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
