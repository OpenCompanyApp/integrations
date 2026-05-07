<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Link scopes to role.
 *
 * Maps to POST /api/roles/{id}/scopes in the official Logto OpenAPI source.
 */
class LogtoCreateRoleScope extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_role_scope',
  'class' => 'LogtoCreateRoleScope',
  'method' => 'POST',
  'path' => '/api/roles/{id}/scopes',
  'operation_id' => 'CreateRoleScope',
  'summary' => 'Link scopes to role',
  'description' => 'Link a list of API resource scopes (permissions) to a role. The original linked scopes will be kept.',
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
