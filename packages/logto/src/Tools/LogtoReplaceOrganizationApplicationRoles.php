<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Replace organization application roles.
 *
 * Maps to PUT /api/organizations/{id}/applications/{applicationId}/roles in the official Logto OpenAPI source.
 */
class LogtoReplaceOrganizationApplicationRoles extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_replace_organization_application_roles',
  'class' => 'LogtoReplaceOrganizationApplicationRoles',
  'method' => 'PUT',
  'path' => '/api/organizations/{id}/applications/{applicationId}/roles',
  'operation_id' => 'ReplaceOrganizationApplicationRoles',
  'summary' => 'Replace organization application roles',
  'description' => 'Replace all roles associated with the application in the organization with the given data.',
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
