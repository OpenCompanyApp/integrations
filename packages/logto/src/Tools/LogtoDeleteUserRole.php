<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Remove role from user.
 *
 * Maps to DELETE /api/users/{userId}/roles/{roleId} in the official Logto OpenAPI source.
 */
class LogtoDeleteUserRole extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_user_role',
  'class' => 'LogtoDeleteUserRole',
  'method' => 'DELETE',
  'path' => '/api/users/{userId}/roles/{roleId}',
  'operation_id' => 'DeleteUserRole',
  'summary' => 'Remove role from user',
  'description' => 'Remove an API resource role from the user.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
    ),
    'role_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the role.',
    ),
  ),
  'path_params' =>
  array (
    'userId' => 'user_id',
    'roleId' => 'role_id',
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
