<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Assign resource scopes to organization role.
 *
 * Maps to POST /api/organization-roles/{id}/resource-scopes in the official Logto OpenAPI source.
 */
class LogtoCreateOrganizationRoleResourceScope extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_organization_role_resource_scope',
  'class' => 'LogtoCreateOrganizationRoleResourceScope',
  'method' => 'POST',
  'path' => '/api/organization-roles/{id}/resource-scopes',
  'operation_id' => 'CreateOrganizationRoleResourceScope',
  'summary' => 'Assign resource scopes to organization role',
  'description' => 'Assign resource scopes to the specified organization role',
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
