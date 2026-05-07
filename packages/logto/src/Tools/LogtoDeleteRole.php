<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete role.
 *
 * Maps to DELETE /api/roles/{id} in the official Logto OpenAPI source.
 */
class LogtoDeleteRole extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_role',
  'class' => 'LogtoDeleteRole',
  'method' => 'DELETE',
  'path' => '/api/roles/{id}',
  'operation_id' => 'DeleteRole',
  'summary' => 'Delete role',
  'description' => 'Delete a role with the given ID.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the role.',
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
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
