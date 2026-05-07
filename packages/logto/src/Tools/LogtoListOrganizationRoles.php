<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get organization roles.
 *
 * Maps to GET /api/organization-roles in the official Logto OpenAPI source.
 */
class LogtoListOrganizationRoles extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_organization_roles',
  'class' => 'LogtoListOrganizationRoles',
  'method' => 'GET',
  'path' => '/api/organization-roles',
  'operation_id' => 'ListOrganizationRoles',
  'summary' => 'Get organization roles',
  'description' => 'Get organization roles with pagination.',
  'parameters' =>
  array (
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
