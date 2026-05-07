<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update user suspension status.
 *
 * Maps to PATCH /api/users/{userId}/is-suspended in the official Logto OpenAPI source.
 */
class LogtoUpdateUserIsSuspended extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_user_is_suspended',
  'class' => 'LogtoUpdateUserIsSuspended',
  'method' => 'PATCH',
  'path' => '/api/users/{userId}/is-suspended',
  'operation_id' => 'UpdateUserIsSuspended',
  'summary' => 'Update user suspension status',
  'description' => 'Update user suspension status for the given ID.',
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
