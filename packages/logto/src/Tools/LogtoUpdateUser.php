<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update user.
 *
 * Maps to PATCH /api/users/{userId} in the official Logto OpenAPI source.
 */
class LogtoUpdateUser extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_user',
  'class' => 'LogtoUpdateUser',
  'method' => 'PATCH',
  'path' => '/api/users/{userId}',
  'operation_id' => 'UpdateUser',
  'summary' => 'Update user',
  'description' => 'Update user data for the given ID. This method performs a partial update.',
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
