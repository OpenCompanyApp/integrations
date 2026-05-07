<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get role scopes.
 *
 * Maps to GET /api/roles/{id}/scopes in the official Logto OpenAPI source.
 */
class LogtoListRoleScopes extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_role_scopes',
  'class' => 'LogtoListRoleScopes',
  'method' => 'GET',
  'path' => '/api/roles/{id}/scopes',
  'operation_id' => 'ListRoleScopes',
  'summary' => 'Get role scopes',
  'description' => 'Get API resource scopes (permissions) linked with a role.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the role.',
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
    'id' => 'id',
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
