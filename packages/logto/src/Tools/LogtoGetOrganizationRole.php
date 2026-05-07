<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get organization role.
 *
 * Maps to GET /api/organization-roles/{id} in the official Logto OpenAPI source.
 */
class LogtoGetOrganizationRole extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_organization_role',
  'class' => 'LogtoGetOrganizationRole',
  'method' => 'GET',
  'path' => '/api/organization-roles/{id}',
  'operation_id' => 'GetOrganizationRole',
  'summary' => 'Get organization role',
  'description' => 'Get organization role details by ID.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization role.',
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
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
