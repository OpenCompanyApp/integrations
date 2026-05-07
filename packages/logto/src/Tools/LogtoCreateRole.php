<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create a role.
 *
 * Maps to POST /api/roles in the official Logto OpenAPI source.
 */
class LogtoCreateRole extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_role',
  'class' => 'LogtoCreateRole',
  'method' => 'POST',
  'path' => '/api/roles',
  'operation_id' => 'CreateRole',
  'summary' => 'Create a role',
  'description' => 'Create a new role with the given data.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
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
