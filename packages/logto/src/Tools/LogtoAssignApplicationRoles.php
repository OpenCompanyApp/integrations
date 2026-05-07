<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Assign API resource roles to application.
 *
 * Maps to POST /api/applications/{applicationId}/roles in the official Logto OpenAPI source.
 */
class LogtoAssignApplicationRoles extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_assign_application_roles',
  'class' => 'LogtoAssignApplicationRoles',
  'method' => 'POST',
  'path' => '/api/applications/{applicationId}/roles',
  'operation_id' => 'AssignApplicationRoles',
  'summary' => 'Assign API resource roles to application',
  'description' => 'Assign API resource roles to the specified application. The API resource roles will be added to the existing API resource roles.',
  'parameters' =>
  array (
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
