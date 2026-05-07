<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get organization scopes.
 *
 * Maps to GET /api/organization-scopes in the official Logto OpenAPI source.
 */
class LogtoListOrganizationScopes extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_organization_scopes',
  'class' => 'LogtoListOrganizationScopes',
  'method' => 'GET',
  'path' => '/api/organization-scopes',
  'operation_id' => 'ListOrganizationScopes',
  'summary' => 'Get organization scopes',
  'description' => 'Get organization scopes that match with optional pagination.',
  'parameters' =>
  array (
    'q' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Logto query parameter `q`.',
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
  ),
  'query_params' =>
  array (
    'q' => 'q',
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
