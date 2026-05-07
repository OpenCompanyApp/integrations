<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Assign roles to applications in an organization.
 *
 * Maps to POST /api/organizations/{id}/applications/roles in the official Logto OpenAPI source.
 */
class LogtoAssignOrganizationRolesToApplications extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_assign_organization_roles_to_applications',
  'class' => 'LogtoAssignOrganizationRolesToApplications',
  'method' => 'POST',
  'path' => '/api/organizations/{id}/applications/roles',
  'operation_id' => 'AssignOrganizationRolesToApplications',
  'summary' => 'Assign roles to applications in an organization',
  'description' => 'Assign roles to applications in the specified organization.',
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
