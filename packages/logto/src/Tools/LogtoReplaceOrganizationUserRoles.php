<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update roles for a user in an organization.
 *
 * Maps to PUT /api/organizations/{id}/users/{userId}/roles in the official Logto OpenAPI source.
 */
class LogtoReplaceOrganizationUserRoles extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_replace_organization_user_roles',
  'class' => 'LogtoReplaceOrganizationUserRoles',
  'method' => 'PUT',
  'path' => '/api/organizations/{id}/users/{userId}/roles',
  'operation_id' => 'ReplaceOrganizationUserRoles',
  'summary' => 'Update roles for a user in an organization',
  'description' => 'Update roles assigned to a user in the specified organization with the provided data.',
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
    'userId' => 'user_id',
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
