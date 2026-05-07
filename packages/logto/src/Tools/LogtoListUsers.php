<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get users.
 *
 * Maps to GET /api/users in the official Logto OpenAPI source.
 */
class LogtoListUsers extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_users',
  'class' => 'LogtoListUsers',
  'method' => 'GET',
  'path' => '/api/users',
  'operation_id' => 'ListUsers',
  'summary' => 'Get users',
  'description' => 'Get users with filters and pagination. Logto provides a very flexible way to query users. You can filter users by almost any fields with multiple modes. To learn more about the query syntax, please refer to [Advanced user search](https://docs.logto.io/docs/recipes/manage-users/advanced-user-search/).',
  'parameters' =>
  array (
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
