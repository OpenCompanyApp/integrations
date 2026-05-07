<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update API resource scope.
 *
 * Maps to PATCH /api/resources/{resourceId}/scopes/{scopeId} in the official Logto OpenAPI source.
 */
class LogtoUpdateResourceScope extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_resource_scope',
  'class' => 'LogtoUpdateResourceScope',
  'method' => 'PATCH',
  'path' => '/api/resources/{resourceId}/scopes/{scopeId}',
  'operation_id' => 'UpdateResourceScope',
  'summary' => 'Update API resource scope',
  'description' => 'Update an API resource scope (permission) for the given resource. This method performs a partial update.',
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
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
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
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
