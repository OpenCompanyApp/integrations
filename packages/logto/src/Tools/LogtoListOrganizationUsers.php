<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get organization user members.
 *
 * Maps to GET /api/organizations/{id}/users in the official Logto OpenAPI source.
 */
class LogtoListOrganizationUsers extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_organization_users',
  'class' => 'LogtoListOrganizationUsers',
  'method' => 'GET',
  'path' => '/api/organizations/{id}/users',
  'operation_id' => 'ListOrganizationUsers',
  'summary' => 'Get organization user members',
  'description' => 'Get users that are members of the specified organization for the given query with pagination.',
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
      'description' => 'The query to filter users. It will match multiple fields of users, including ID, name, username, email, and phone number. If not provided, all users will be returned.',
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
