<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update user password.
 *
 * Maps to PATCH /api/users/{userId}/password in the official Logto OpenAPI source.
 */
class LogtoUpdateUserPassword extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_user_password',
  'class' => 'LogtoUpdateUserPassword',
  'method' => 'PATCH',
  'path' => '/api/users/{userId}/password',
  'operation_id' => 'UpdateUserPassword',
  'summary' => 'Update user password',
  'description' => 'Update user password for the given ID.',
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
