<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Assign roles to user.
 *
 * Maps to POST /api/users/{userId}/roles in the official Logto OpenAPI source.
 */
class LogtoAssignUserRoles extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_assign_user_roles',
  'class' => 'LogtoAssignUserRoles',
  'method' => 'POST',
  'path' => '/api/users/{userId}/roles',
  'operation_id' => 'AssignUserRoles',
  'summary' => 'Assign roles to user',
  'description' => 'Assign API resource roles to the user. The roles will be added to the existing roles.',
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
