<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update API resource.
 *
 * Maps to PATCH /api/resources/{id} in the official Logto OpenAPI source.
 */
class LogtoUpdateResource extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_resource',
  'class' => 'LogtoUpdateResource',
  'method' => 'PATCH',
  'path' => '/api/resources/{id}',
  'operation_id' => 'UpdateResource',
  'summary' => 'Update API resource',
  'description' => 'Update an API resource details by ID with the given data. This method performs a partial update.',
  'parameters' =>
  array (
    'id' =>
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
