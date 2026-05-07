<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get application API resource roles.
 *
 * Maps to GET /api/applications/{applicationId}/roles in the official Logto OpenAPI source.
 */
class LogtoListApplicationRoles extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_application_roles',
  'class' => 'LogtoListApplicationRoles',
  'method' => 'GET',
  'path' => '/api/applications/{applicationId}/roles',
  'operation_id' => 'ListApplicationRoles',
  'summary' => 'Get application API resource roles',
  'description' => 'Get API resource roles assigned to the specified application with pagination.',
  'parameters' =>
  array (
    'application_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the application.',
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
    'applicationId' => 'application_id',
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
