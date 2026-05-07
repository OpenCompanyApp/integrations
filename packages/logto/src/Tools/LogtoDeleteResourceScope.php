<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete API resource scope.
 *
 * Maps to DELETE /api/resources/{resourceId}/scopes/{scopeId} in the official Logto OpenAPI source.
 */
class LogtoDeleteResourceScope extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_resource_scope',
  'class' => 'LogtoDeleteResourceScope',
  'method' => 'DELETE',
  'path' => '/api/resources/{resourceId}/scopes/{scopeId}',
  'operation_id' => 'DeleteResourceScope',
  'summary' => 'Delete API resource scope',
  'description' => 'Delete an API resource scope (permission) from the given resource.',
  'parameters' =>
  array (
    'resource_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the resource.',
    ),
    'scope_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the scope.',
    ),
  ),
  'path_params' =>
  array (
    'resourceId' => 'resource_id',
    'scopeId' => 'scope_id',
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
