<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get roles for a user in an organization.
 *
 * Maps to GET /api/organizations/{id}/users/{userId}/roles in the official Logto OpenAPI source.
 */
class LogtoListOrganizationUserRoles extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_organization_user_roles',
  'class' => 'LogtoListOrganizationUserRoles',
  'method' => 'GET',
  'path' => '/api/organizations/{id}/users/{userId}/roles',
  'operation_id' => 'ListOrganizationUserRoles',
  'summary' => 'Get roles for a user in an organization',
  'description' => 'Get roles assigned to a user in the specified organization with pagination.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization.',
    ),
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
  ),
  'path_params' =>
  array (
    'id' => 'id',
    'userId' => 'user_id',
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
