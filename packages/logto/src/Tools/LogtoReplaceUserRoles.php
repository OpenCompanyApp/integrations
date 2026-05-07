<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update roles for user.
 *
 * Maps to PUT /api/users/{userId}/roles in the official Logto OpenAPI source.
 */
class LogtoReplaceUserRoles extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_replace_user_roles',
  'class' => 'LogtoReplaceUserRoles',
  'method' => 'PUT',
  'path' => '/api/users/{userId}/roles',
  'operation_id' => 'ReplaceUserRoles',
  'summary' => 'Update roles for user',
  'description' => 'Update API resource roles assigned to the user. This will replace the existing roles.',
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
