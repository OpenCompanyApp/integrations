<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Remove a API resource role from application.
 *
 * Maps to DELETE /api/applications/{applicationId}/roles/{roleId} in the official Logto OpenAPI source.
 */
class LogtoDeleteApplicationRole extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_application_role',
  'class' => 'LogtoDeleteApplicationRole',
  'method' => 'DELETE',
  'path' => '/api/applications/{applicationId}/roles/{roleId}',
  'operation_id' => 'DeleteApplicationRole',
  'summary' => 'Remove a API resource role from application',
  'description' => 'Remove a API resource role from the specified application.',
  'parameters' =>
  array (
    'application_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the application.',
    ),
    'role_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the role.',
    ),
  ),
  'path_params' =>
  array (
    'applicationId' => 'application_id',
    'roleId' => 'role_id',
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
