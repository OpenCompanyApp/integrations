<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get roles for user.
 *
 * Maps to GET /api/users/{userId}/roles in the official Logto OpenAPI source.
 */
class LogtoListUserRoles extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_user_roles',
  'class' => 'LogtoListUserRoles',
  'method' => 'GET',
  'path' => '/api/users/{userId}/roles',
  'operation_id' => 'ListUserRoles',
  'summary' => 'Get roles for user',
  'description' => 'Get API resource roles assigned to the user with pagination.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
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
    'userId' => 'user_id',
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
