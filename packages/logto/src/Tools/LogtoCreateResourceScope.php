<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create API resource scope.
 *
 * Maps to POST /api/resources/{resourceId}/scopes in the official Logto OpenAPI source.
 */
class LogtoCreateResourceScope extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_resource_scope',
  'class' => 'LogtoCreateResourceScope',
  'method' => 'POST',
  'path' => '/api/resources/{resourceId}/scopes',
  'operation_id' => 'CreateResourceScope',
  'summary' => 'Create API resource scope',
  'description' => 'Create a new scope (permission) for an API resource.',
  'parameters' =>
  array (
    'resource_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the resource.',
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
