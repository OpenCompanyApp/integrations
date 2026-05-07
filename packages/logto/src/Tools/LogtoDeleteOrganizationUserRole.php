<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Remove a role from a user in an organization.
 *
 * Maps to DELETE /api/organizations/{id}/users/{userId}/roles/{organizationRoleId} in the official Logto OpenAPI source.
 */
class LogtoDeleteOrganizationUserRole extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_organization_user_role',
  'class' => 'LogtoDeleteOrganizationUserRole',
  'method' => 'DELETE',
  'path' => '/api/organizations/{id}/users/{userId}/roles/{organizationRoleId}',
  'operation_id' => 'DeleteOrganizationUserRole',
  'summary' => 'Remove a role from a user in an organization',
  'description' => 'Remove a role assignment from a user in the specified organization.',
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
    'organization_role_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the organization role.',
    ),
  ),
  'path_params' =>
  array (
    'id' => 'id',
    'userId' => 'user_id',
    'organizationRoleId' => 'organization_role_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
