<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Replace resource scopes for organization role.
 *
 * Maps to PUT /api/organization-roles/{id}/resource-scopes in the official Logto OpenAPI source.
 */
class LogtoReplaceOrganizationRoleResourceScopes extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_replace_organization_role_resource_scopes',
  'class' => 'LogtoReplaceOrganizationRoleResourceScopes',
  'method' => 'PUT',
  'path' => '/api/organization-roles/{id}/resource-scopes',
  'operation_id' => 'ReplaceOrganizationRoleResourceScopes',
  'summary' => 'Replace resource scopes for organization role',
  'description' => 'Replace all resource scopes that are assigned to the specified organization role with the given resource scopes. This effectively removes all existing organization scope assignments and replaces them with the new ones.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization role.',
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
