<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Remove organization scope.
 *
 * Maps to DELETE /api/organization-roles/{id}/scopes/{organizationScopeId} in the official Logto OpenAPI source.
 */
class LogtoDeleteOrganizationRoleScope extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_organization_role_scope',
  'class' => 'LogtoDeleteOrganizationRoleScope',
  'method' => 'DELETE',
  'path' => '/api/organization-roles/{id}/scopes/{organizationScopeId}',
  'operation_id' => 'DeleteOrganizationRoleScope',
  'summary' => 'Remove organization scope',
  'description' => 'Remove a organization scope assignment from the specified organization role.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization role.',
    ),
    'organization_scope_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization scope.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
    'organizationScopeId' => 'organization_scope_id',
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
