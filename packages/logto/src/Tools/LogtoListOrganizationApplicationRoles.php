<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get organization application roles.
 *
 * Maps to GET /api/organizations/{id}/applications/{applicationId}/roles in the official Logto OpenAPI source.
 */
class LogtoListOrganizationApplicationRoles extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_organization_application_roles',
  'class' => 'LogtoListOrganizationApplicationRoles',
  'method' => 'GET',
  'path' => '/api/organizations/{id}/applications/{applicationId}/roles',
  'operation_id' => 'ListOrganizationApplicationRoles',
  'summary' => 'Get organization application roles',
  'description' => 'Get roles associated with the application in the organization.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization.',
    ),
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
  ),
  'path_params' =>
  array (
    'id' => 'id',
    'applicationId' => 'application_id',
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
