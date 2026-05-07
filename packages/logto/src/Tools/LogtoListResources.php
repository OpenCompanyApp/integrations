<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get API resources.
 *
 * Maps to GET /api/resources in the official Logto OpenAPI source.
 */
class LogtoListResources extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_resources',
  'class' => 'LogtoListResources',
  'method' => 'GET',
  'path' => '/api/resources',
  'operation_id' => 'ListResources',
  'summary' => 'Get API resources',
  'description' => 'Get API resources in the current tenant with pagination.',
  'parameters' =>
  array (
    'include_scopes' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'If it\'s provided with a truthy value (`true`, `1`, `yes`), the scopes of each resource will be included in the response.',
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
    'includeScopes' => 'include_scopes',
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
