<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get organization role resource scopes.
 *
 * Maps to GET /api/organization-roles/{id}/resource-scopes in the official Logto OpenAPI source.
 */
class LogtoListOrganizationRoleResourceScopes extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_organization_role_resource_scopes',
  'class' => 'LogtoListOrganizationRoleResourceScopes',
  'method' => 'GET',
  'path' => '/api/organization-roles/{id}/resource-scopes',
  'operation_id' => 'ListOrganizationRoleResourceScopes',
  'summary' => 'Get organization role resource scopes',
  'description' => 'Get resource scopes that are assigned to the specified organization role with optional pagination.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization role.',
    ),
    'page' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Page number (starts from 1).',
    ),
    'page_size' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Entries per page.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
  ),
  'query_params' =>
  array (
    'page' => 'page',
    'page_size' => 'page_size',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
