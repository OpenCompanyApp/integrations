<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get API resource scopes.
 *
 * Maps to GET /api/resources/{resourceId}/scopes in the official Logto OpenAPI source.
 */
class LogtoListResourceScopes extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_resource_scopes',
  'class' => 'LogtoListResourceScopes',
  'method' => 'GET',
  'path' => '/api/resources/{resourceId}/scopes',
  'operation_id' => 'ListResourceScopes',
  'summary' => 'Get API resource scopes',
  'description' => 'Get scopes (permissions) defined for an API resource.',
  'parameters' =>
  array (
    'resource_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the resource.',
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
    'search_params' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Search query parameters.',
    ),
  ),
  'path_params' =>
  array (
    'resourceId' => 'resource_id',
  ),
  'query_params' =>
  array (
    'page' => 'page',
    'page_size' => 'page_size',
    'search_params' => 'search_params',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
