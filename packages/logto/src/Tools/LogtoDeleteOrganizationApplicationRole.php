<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Remove organization application role.
 *
 * Maps to DELETE /api/organizations/{id}/applications/{applicationId}/roles/{organizationRoleId} in the official Logto OpenAPI source.
 */
class LogtoDeleteOrganizationApplicationRole extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_organization_application_role',
  'class' => 'LogtoDeleteOrganizationApplicationRole',
  'method' => 'DELETE',
  'path' => '/api/organizations/{id}/applications/{applicationId}/roles/{organizationRoleId}',
  'operation_id' => 'DeleteOrganizationApplicationRole',
  'summary' => 'Remove organization application role',
  'description' => 'Remove a role from the application in the organization.',
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
    'applicationId' => 'application_id',
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
