<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get role users.
 *
 * Maps to GET /api/roles/{id}/users in the official Logto OpenAPI source.
 */
class LogtoListRoleUsers extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_role_users',
  'class' => 'LogtoListRoleUsers',
  'method' => 'GET',
  'path' => '/api/roles/{id}/users',
  'operation_id' => 'ListRoleUsers',
  'summary' => 'Get role users',
  'description' => 'Get users who have the role assigned with pagination.',
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
