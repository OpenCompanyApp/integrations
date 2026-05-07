<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update API resource roles for application.
 *
 * Maps to PUT /api/applications/{applicationId}/roles in the official Logto OpenAPI source.
 */
class LogtoReplaceApplicationRoles extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_replace_application_roles',
  'class' => 'LogtoReplaceApplicationRoles',
  'method' => 'PUT',
  'path' => '/api/applications/{applicationId}/roles',
  'operation_id' => 'ReplaceApplicationRoles',
  'summary' => 'Update API resource roles for application',
  'description' => 'Update API resource roles assigned to the specified application. This will replace the existing API resource roles.',
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
