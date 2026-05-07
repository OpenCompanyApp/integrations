<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update organization role.
 *
 * Maps to PATCH /api/organization-roles/{id} in the official Logto OpenAPI source.
 */
class LogtoUpdateOrganizationRole extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_organization_role',
  'class' => 'LogtoUpdateOrganizationRole',
  'method' => 'PATCH',
  'path' => '/api/organization-roles/{id}',
  'operation_id' => 'UpdateOrganizationRole',
  'summary' => 'Update organization role',
  'description' => 'Update organization role details by ID with the given data.',
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
