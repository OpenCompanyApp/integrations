<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Retrieve a user's enterprise SSO identity and associated token secret (if token storage is enabled).
 *
 * Maps to GET /api/users/{userId}/sso-identities/{ssoConnectorId} in the official Logto OpenAPI source.
 */
class LogtoGetUserSsoIdentity extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_user_sso_identity',
  'class' => 'LogtoGetUserSsoIdentity',
  'method' => 'GET',
  'path' => '/api/users/{userId}/sso-identities/{ssoConnectorId}',
  'operation_id' => 'GetUserSsoIdentity',
  'summary' => 'Retrieve a user\'s enterprise SSO identity and associated token secret (if token storage is enabled)',
  'description' => 'This API retrieves the user\'s enterprise SSO identity and associated token set record from the Logto Secret Vault. The token set will only be available if token storage is enabled for the corresponding SSO connector.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
    ),
    'sso_connector_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the sso connector.',
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
    'ssoConnectorId' => 'sso_connector_id',
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
