<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Unlink scope from role.
 *
 * Maps to DELETE /api/roles/{id}/scopes/{scopeId} in the official Logto OpenAPI source.
 */
class LogtoDeleteRoleScope extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_role_scope',
  'class' => 'LogtoDeleteRoleScope',
  'method' => 'DELETE',
  'path' => '/api/roles/{id}/scopes/{scopeId}',
  'operation_id' => 'DeleteRoleScope',
  'summary' => 'Unlink scope from role',
  'description' => 'Unlink an API resource scope (permission) from a role with the given ID.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the role.',
    ),
    'scope_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the scope.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
    'scopeId' => 'scope_id',
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
