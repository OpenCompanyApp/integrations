<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Add user members to organization.
 *
 * Maps to POST /api/organizations/{id}/users in the official Logto OpenAPI source.
 */
class LogtoAddOrganizationUsers extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_add_organization_users',
  'class' => 'LogtoAddOrganizationUsers',
  'method' => 'POST',
  'path' => '/api/organizations/{id}/users',
  'operation_id' => 'AddOrganizationUsers',
  'summary' => 'Add user members to organization',
  'description' => 'Add users as members to the specified organization with the given user IDs.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
