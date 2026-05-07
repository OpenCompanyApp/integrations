<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get organization applications.
 *
 * Maps to GET /api/organizations/{id}/applications in the official Logto OpenAPI source.
 */
class LogtoListOrganizationApplications extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_organization_applications',
  'class' => 'LogtoListOrganizationApplications',
  'method' => 'GET',
  'path' => '/api/organizations/{id}/applications',
  'operation_id' => 'ListOrganizationApplications',
  'summary' => 'Get organization applications',
  'description' => 'Get applications associated with the organization.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization.',
    ),
    'q' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Logto query parameter `q`.',
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
    'q' => 'q',
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
