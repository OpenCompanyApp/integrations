<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Assign role to applications.
 *
 * Maps to POST /api/roles/{id}/applications in the official Logto OpenAPI source.
 */
class LogtoCreateRoleApplication extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_role_application',
  'class' => 'LogtoCreateRoleApplication',
  'method' => 'POST',
  'path' => '/api/roles/{id}/applications',
  'operation_id' => 'CreateRoleApplication',
  'summary' => 'Assign role to applications',
  'description' => 'Assign a role to a list of applications. The role must have the type `Application`.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the role.',
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
