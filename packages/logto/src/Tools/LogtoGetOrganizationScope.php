<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get organization scope.
 *
 * Maps to GET /api/organization-scopes/{id} in the official Logto OpenAPI source.
 */
class LogtoGetOrganizationScope extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_organization_scope',
  'class' => 'LogtoGetOrganizationScope',
  'method' => 'GET',
  'path' => '/api/organization-scopes/{id}',
  'operation_id' => 'GetOrganizationScope',
  'summary' => 'Get organization scope',
  'description' => 'Get organization scope details by ID.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization scope.',
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
