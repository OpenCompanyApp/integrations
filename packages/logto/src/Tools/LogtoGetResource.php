<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get API resource.
 *
 * Maps to GET /api/resources/{id} in the official Logto OpenAPI source.
 */
class LogtoGetResource extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_resource',
  'class' => 'LogtoGetResource',
  'method' => 'GET',
  'path' => '/api/resources/{id}',
  'operation_id' => 'GetResource',
  'summary' => 'Get API resource',
  'description' => 'Get an API resource details by ID.',
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
  'type' => 'read',
);
}
