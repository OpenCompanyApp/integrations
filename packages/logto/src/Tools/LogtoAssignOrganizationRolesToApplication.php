<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Add organization application role.
 *
 * Maps to POST /api/organizations/{id}/applications/{applicationId}/roles in the official Logto OpenAPI source.
 */
class LogtoAssignOrganizationRolesToApplication extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_assign_organization_roles_to_application',
  'class' => 'LogtoAssignOrganizationRolesToApplication',
  'method' => 'POST',
  'path' => '/api/organizations/{id}/applications/{applicationId}/roles',
  'operation_id' => 'AssignOrganizationRolesToApplication',
  'summary' => 'Add organization application role',
  'description' => 'Add a role to the application in the organization.',
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
    'applicationId' => 'application_id',
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
