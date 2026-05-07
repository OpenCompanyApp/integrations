<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get organizations.
 *
 * Maps to GET /api/organizations in the official Logto OpenAPI source.
 */
class LogtoListOrganizations extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_organizations',
  'class' => 'LogtoListOrganizations',
  'method' => 'GET',
  'path' => '/api/organizations',
  'operation_id' => 'ListOrganizations',
  'summary' => 'Get organizations',
  'description' => 'Get organizations that match the given query with pagination.',
  'parameters' =>
  array (
    'q' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The query to filter organizations. It can be a partial ID or name. If not provided, all organizations will be returned.',
    ),
    'show_featured' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Whether to show featured users in the organization. Featured users are randomly selected from the organization members. If not provided, `featuredUsers` will not be included in the response.',
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
    'q' => 'q',
    'showFeatured' => 'show_featured',
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
