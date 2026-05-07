<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get user.
 *
 * Maps to GET /api/users/{userId} in the official Logto OpenAPI source.
 */
class LogtoGetUser extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_user',
  'class' => 'LogtoGetUser',
  'method' => 'GET',
  'path' => '/api/users/{userId}',
  'operation_id' => 'GetUser',
  'summary' => 'Get user',
  'description' => 'Get user data for the given ID.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
    ),
    'include_sso_identities' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'If it\'s provided with a truthy value (`true`, `1`, `yes`), each user in the response will include a `ssoIdentities` property containing a list of SSO identities associated with the user.',
    ),
    'include_password_hash' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'If it\'s provided with a truthy value (`true`, `1`, `yes`), the response will include the `passwordDigest` and `passwordAlgorithm` fields. These fields are omitted by default for security reasons.',
    ),
  ),
  'path_params' =>
  array (
    'userId' => 'user_id',
  ),
  'query_params' =>
  array (
    'includeSsoIdentities' => 'include_sso_identities',
    'includePasswordHash' => 'include_password_hash',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
