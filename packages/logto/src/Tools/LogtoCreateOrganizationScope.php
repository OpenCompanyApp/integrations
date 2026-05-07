<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create an organization scope.
 *
 * Maps to POST /api/organization-scopes in the official Logto OpenAPI source.
 */
class LogtoCreateOrganizationScope extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_organization_scope',
  'class' => 'LogtoCreateOrganizationScope',
  'method' => 'POST',
  'path' => '/api/organization-scopes',
  'operation_id' => 'CreateOrganizationScope',
  'summary' => 'Create an organization scope',
  'description' => 'Create a new organization scope with the given data.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
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
