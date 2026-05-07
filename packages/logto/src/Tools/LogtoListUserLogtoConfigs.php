<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get user logto config.
 *
 * Maps to GET /api/users/{userId}/logto-configs in the official Logto OpenAPI source.
 */
class LogtoListUserLogtoConfigs extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_user_logto_configs',
  'class' => 'LogtoListUserLogtoConfigs',
  'method' => 'GET',
  'path' => '/api/users/{userId}/logto-configs',
  'operation_id' => 'ListUserLogtoConfigs',
  'summary' => 'Get user logto config',
  'description' => 'Retrieve the exposed portion of a user\'s logto config. Includes MFA states (enabled, skipped, skipMfaOnSignIn) and passkey sign-in states (skipped).',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
    ),
  ),
  'path_params' =>
  array (
    'userId' => 'user_id',
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
