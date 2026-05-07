<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create an API resource.
 *
 * Maps to POST /api/resources in the official Logto OpenAPI source.
 */
class LogtoCreateResource extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_resource',
  'class' => 'LogtoCreateResource',
  'method' => 'POST',
  'path' => '/api/resources',
  'operation_id' => 'CreateResource',
  'summary' => 'Create an API resource',
  'description' => 'Create an API resource in the current tenant.',
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
