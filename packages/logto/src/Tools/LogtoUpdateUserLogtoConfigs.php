<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update user logto config.
 *
 * Maps to PATCH /api/users/{userId}/logto-configs in the official Logto OpenAPI source.
 */
class LogtoUpdateUserLogtoConfigs extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_user_logto_configs',
  'class' => 'LogtoUpdateUserLogtoConfigs',
  'method' => 'PATCH',
  'path' => '/api/users/{userId}/logto-configs',
  'operation_id' => 'UpdateUserLogtoConfigs',
  'summary' => 'Update user logto config',
  'description' => 'Update the exposed portion of a user\'s logto config. Supports updating MFA states (enabled, skipped, skipMfaOnSignIn) and passkey sign-in states (skipped). All fields are optional - only provided fields will be updated.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
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
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
