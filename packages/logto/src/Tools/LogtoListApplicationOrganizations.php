<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get application organizations.
 *
 * Maps to GET /api/applications/{id}/organizations in the official Logto OpenAPI source.
 */
class LogtoListApplicationOrganizations extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_application_organizations',
  'class' => 'LogtoListApplicationOrganizations',
  'method' => 'GET',
  'path' => '/api/applications/{id}/organizations',
  'operation_id' => 'ListApplicationOrganizations',
  'summary' => 'Get application organizations',
  'description' => 'Get the list of organizations that an application is associated with.',
  'parameters' =>
  array (
    'id' =>
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
  ),
  'path_params' =>
  array (
    'id' => 'id',
  ),
  'query_params' =>
  array (
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
