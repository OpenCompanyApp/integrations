<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update organization scope.
 *
 * Maps to PATCH /api/organization-scopes/{id} in the official Logto OpenAPI source.
 */
class LogtoUpdateOrganizationScope extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_organization_scope',
  'class' => 'LogtoUpdateOrganizationScope',
  'method' => 'PATCH',
  'path' => '/api/organization-scopes/{id}',
  'operation_id' => 'UpdateOrganizationScope',
  'summary' => 'Update organization scope',
  'description' => 'Update organization scope details by ID with the given data.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization scope.',
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
