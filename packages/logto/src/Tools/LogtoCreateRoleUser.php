<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Assign role to users.
 *
 * Maps to POST /api/roles/{id}/users in the official Logto OpenAPI source.
 */
class LogtoCreateRoleUser extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_role_user',
  'class' => 'LogtoCreateRoleUser',
  'method' => 'POST',
  'path' => '/api/roles/{id}/users',
  'operation_id' => 'CreateRoleUser',
  'summary' => 'Assign role to users',
  'description' => 'Assign a role to a list of users. The role must have the type `User`.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the role.',
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
    'id' => 'id',
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
