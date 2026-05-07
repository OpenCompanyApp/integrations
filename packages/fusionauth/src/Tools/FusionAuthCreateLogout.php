<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Logout.
 *
 * Maps to POST /api/logout in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateLogout extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_logout',
  'class' => 'FusionAuthCreateLogout',
  'method' => 'POST',
  'path' => '/api/logout',
  'operation_id' => 'createLogout',
  'summary' => 'create Logout',
  'description' => 'The Logout API is intended to be used to remove the refresh token and access token cookies if they exist on the client and revoke the refresh token stored. This API takes the refresh token in the JSON body. OR The Logout API is intended to be used to remove the refresh token and access token cookies if they exist on the client and revoke the refresh token stored. This API does nothing if the request does not contain an access token or refresh token cookies.',
  'parameters' =>
  array (
    'global' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'When this value is set to true all the refresh tokens issued to the owner of the provided token will be revoked.',
    ),
    'refresh_token' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The refresh_token as a request parameter instead of coming in via a cookie. If provided this takes precedence over the cookie.',
    ),
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
    'global' => 'global',
    'refreshToken' => 'refresh_token',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
