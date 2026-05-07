<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create an application.
 *
 * Maps to POST /api/applications in the official Logto OpenAPI source.
 */
class LogtoCreateApplication extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_application',
  'class' => 'LogtoCreateApplication',
  'method' => 'POST',
  'path' => '/api/applications',
  'operation_id' => 'CreateApplication',
  'summary' => 'Create an application',
  'description' => 'Create a new application with the given data.',
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
