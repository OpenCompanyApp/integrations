<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Remove resource scope.
 *
 * Maps to DELETE /api/organization-roles/{id}/resource-scopes/{scopeId} in the official Logto OpenAPI source.
 */
class LogtoDeleteOrganizationRoleResourceScope extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_organization_role_resource_scope',
  'class' => 'LogtoDeleteOrganizationRoleResourceScope',
  'method' => 'DELETE',
  'path' => '/api/organization-roles/{id}/resource-scopes/{scopeId}',
  'operation_id' => 'DeleteOrganizationRoleResourceScope',
  'summary' => 'Remove resource scope',
  'description' => 'Remove a resource scope assignment from the specified organization role.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization role.',
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
