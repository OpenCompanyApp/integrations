<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Remove role from user.
 *
 * Maps to DELETE /api/roles/{id}/users/{userId} in the official Logto OpenAPI source.
 */
class LogtoDeleteRoleUser extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_role_user',
  'class' => 'LogtoDeleteRoleUser',
  'method' => 'DELETE',
  'path' => '/api/roles/{id}/users/{userId}',
  'operation_id' => 'DeleteRoleUser',
  'summary' => 'Remove role from user',
  'description' => 'Remove a role from a user with the given ID.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the role.',
    ),
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
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
