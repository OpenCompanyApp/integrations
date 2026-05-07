<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Assign roles to a user in an organization.
 *
 * Maps to POST /api/organizations/{id}/users/{userId}/roles in the official Logto OpenAPI source.
 */
class LogtoAssignOrganizationRolesToUser extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_assign_organization_roles_to_user',
  'class' => 'LogtoAssignOrganizationRolesToUser',
  'method' => 'POST',
  'path' => '/api/organizations/{id}/users/{userId}/roles',
  'operation_id' => 'AssignOrganizationRolesToUser',
  'summary' => 'Assign roles to a user in an organization',
  'description' => 'Assign roles to a user in the specified organization with the provided data.',
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
