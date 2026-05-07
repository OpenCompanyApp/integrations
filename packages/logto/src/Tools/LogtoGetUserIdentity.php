<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Retrieve a user's social identity and associated token storage .
 *
 * Maps to GET /api/users/{userId}/identities/{target} in the official Logto OpenAPI source.
 */
class LogtoGetUserIdentity extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_user_identity',
  'class' => 'LogtoGetUserIdentity',
  'method' => 'GET',
  'path' => '/api/users/{userId}/identities/{target}',
  'operation_id' => 'GetUserIdentity',
  'summary' => 'Retrieve a user\'s social identity and associated token storage ',
  'description' => 'This API retrieves the social identity and its associated token set for the specified user from the Logto Secret Vault. The token set will only be available if token storage is enabled for the corresponding social connector.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
    ),
    'target' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Logto path parameter `target`.',
    ),
    'include_token_secret' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Whether to include the token secret in the response. Defaults to false. Token storage must be supported and enabled by the connector to return the token secret.',
    ),
  ),
  'path_params' =>
  array (
    'userId' => 'user_id',
    'target' => 'target',
  ),
  'query_params' =>
  array (
    'includeTokenSecret' => 'include_token_secret',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
