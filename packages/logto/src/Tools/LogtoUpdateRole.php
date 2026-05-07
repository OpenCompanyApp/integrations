<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update role.
 *
 * Maps to PATCH /api/roles/{id} in the official Logto OpenAPI source.
 */
class LogtoUpdateRole extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_role',
  'class' => 'LogtoUpdateRole',
  'method' => 'PATCH',
  'path' => '/api/roles/{id}',
  'operation_id' => 'UpdateRole',
  'summary' => 'Update role',
  'description' => 'Update role details. This method performs a partial update.',
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
