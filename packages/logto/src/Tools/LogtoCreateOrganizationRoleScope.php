<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Assign organization scopes to organization role.
 *
 * Maps to POST /api/organization-roles/{id}/scopes in the official Logto OpenAPI source.
 */
class LogtoCreateOrganizationRoleScope extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_organization_role_scope',
  'class' => 'LogtoCreateOrganizationRoleScope',
  'method' => 'POST',
  'path' => '/api/organization-roles/{id}/scopes',
  'operation_id' => 'CreateOrganizationRoleScope',
  'summary' => 'Assign organization scopes to organization role',
  'description' => 'Assign organization scopes to the specified organization role',
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
