<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Refresh Tokens With Id.
 *
 * Maps to GET /api/jwt/refresh in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveRefreshTokensWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_refresh_tokens_with_id',
  'class' => 'FusionAuthRetrieveRefreshTokensWithId',
  'method' => 'GET',
  'path' => '/api/jwt/refresh',
  'operation_id' => 'retrieveRefreshTokensWithId',
  'summary' => 'retrieve Refresh Tokens With Id',
  'description' => 'Retrieves the refresh tokens that belong to the user with the given Id.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The Id of the user.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'userId' => 'user_id',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
