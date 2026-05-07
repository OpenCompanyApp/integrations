<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get role applications.
 *
 * Maps to GET /api/roles/{id}/applications in the official Logto OpenAPI source.
 */
class LogtoListRoleApplications extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_role_applications',
  'class' => 'LogtoListRoleApplications',
  'method' => 'GET',
  'path' => '/api/roles/{id}/applications',
  'operation_id' => 'ListRoleApplications',
  'summary' => 'Get role applications',
  'description' => 'Get applications that have the role assigned with pagination.',
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
