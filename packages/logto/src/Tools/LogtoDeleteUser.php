<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete user.
 *
 * Maps to DELETE /api/users/{userId} in the official Logto OpenAPI source.
 */
class LogtoDeleteUser extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_user',
  'class' => 'LogtoDeleteUser',
  'method' => 'DELETE',
  'path' => '/api/users/{userId}',
  'operation_id' => 'DeleteUser',
  'summary' => 'Delete user',
  'description' => 'Delete user with the given ID. Note all associated data will be deleted cascadingly.',
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
  'type' => 'write',
);
}
