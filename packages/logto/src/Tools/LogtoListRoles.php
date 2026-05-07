<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get roles.
 *
 * Maps to GET /api/roles in the official Logto OpenAPI source.
 */
class LogtoListRoles extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_roles',
  'class' => 'LogtoListRoles',
  'method' => 'GET',
  'path' => '/api/roles',
  'operation_id' => 'ListRoles',
  'summary' => 'Get roles',
  'description' => 'Get roles with filters and pagination.',
  'parameters' =>
  array (
    'exclude_user_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Exclude roles assigned to a user.',
    ),
    'exclude_application_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Exclude roles assigned to an application.',
    ),
    'type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Filter by role type.',
      'enum' =>
      array (
        0 => 'User',
        1 => 'MachineToMachine',
      ),
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
  ),
  'query_params' =>
  array (
    'excludeUserId' => 'exclude_user_id',
    'excludeApplicationId' => 'exclude_application_id',
    'type' => 'type',
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
