<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Retrieve social identities, enterprise SSO identities and associated token secret (if token storage is enabled) for a user.
 *
 * Maps to GET /api/users/{userId}/all-identities in the official Logto OpenAPI source.
 */
class LogtoListUserAllIdentities extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_user_all_identities',
  'class' => 'LogtoListUserAllIdentities',
  'method' => 'GET',
  'path' => '/api/users/{userId}/all-identities',
  'operation_id' => 'ListUserAllIdentities',
  'summary' => 'Retrieve social identities, enterprise SSO identities and associated token secret (if token storage is enabled) for a user',
  'description' => 'This API retrieves all identities (social and enterprise SSO) for a user, along with their associated token set records from the Logto Secret Vault. The token sets will only be available if token storage is enabled for the corresponding identity connector.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
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
