<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete API resource.
 *
 * Maps to DELETE /api/resources/{id} in the official Logto OpenAPI source.
 */
class LogtoDeleteResource extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_resource',
  'class' => 'LogtoDeleteResource',
  'method' => 'DELETE',
  'path' => '/api/resources/{id}',
  'operation_id' => 'DeleteResource',
  'summary' => 'Delete API resource',
  'description' => 'Delete an API resource by ID.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the resource.',
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
