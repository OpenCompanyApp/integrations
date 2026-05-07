<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get application.
 *
 * Maps to GET /api/applications/{id} in the official Logto OpenAPI source.
 */
class LogtoGetApplication extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_application',
  'class' => 'LogtoGetApplication',
  'method' => 'GET',
  'path' => '/api/applications/{id}',
  'operation_id' => 'GetApplication',
  'summary' => 'Get application',
  'description' => 'Get application details by ID.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the application.',
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
