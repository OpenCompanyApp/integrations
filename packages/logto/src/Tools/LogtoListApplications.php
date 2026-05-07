<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get applications.
 *
 * Maps to GET /api/applications in the official Logto OpenAPI source.
 */
class LogtoListApplications extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_applications',
  'class' => 'LogtoListApplications',
  'method' => 'GET',
  'path' => '/api/applications',
  'operation_id' => 'ListApplications',
  'summary' => 'Get applications',
  'description' => 'Get applications that match the given query with pagination.',
  'parameters' =>
  array (
    'types' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'An array of application types to filter applications.',
    ),
    'exclude_role_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Logto query parameter `excludeRoleId`.',
    ),
    'exclude_organization_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Logto query parameter `excludeOrganizationId`.',
    ),
    'is_third_party' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official Logto query parameter `isThirdParty`.',
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
    'types' => 'types',
    'excludeRoleId' => 'exclude_role_id',
    'excludeOrganizationId' => 'exclude_organization_id',
    'isThirdParty' => 'is_third_party',
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
