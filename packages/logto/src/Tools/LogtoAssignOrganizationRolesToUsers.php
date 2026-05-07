<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Assign roles to organization user members.
 *
 * Maps to POST /api/organizations/{id}/users/roles in the official Logto OpenAPI source.
 */
class LogtoAssignOrganizationRolesToUsers extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_assign_organization_roles_to_users',
  'class' => 'LogtoAssignOrganizationRolesToUsers',
  'method' => 'POST',
  'path' => '/api/organizations/{id}/users/roles',
  'operation_id' => 'AssignOrganizationRolesToUsers',
  'summary' => 'Assign roles to organization user members',
  'description' => 'Assign roles to user members of the specified organization.',
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
