<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Remove role from application.
 *
 * Maps to DELETE /api/roles/{id}/applications/{applicationId} in the official Logto OpenAPI source.
 */
class LogtoDeleteRoleApplication extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_role_application',
  'class' => 'LogtoDeleteRoleApplication',
  'method' => 'DELETE',
  'path' => '/api/roles/{id}/applications/{applicationId}',
  'operation_id' => 'DeleteRoleApplication',
  'summary' => 'Remove role from application',
  'description' => 'Remove the role from an application with the given ID.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the role.',
    ),
    'application_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the application.',
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
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
