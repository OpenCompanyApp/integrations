<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update application.
 *
 * Maps to PATCH /api/applications/{id} in the official Logto OpenAPI source.
 */
class LogtoUpdateApplication extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_application',
  'class' => 'LogtoUpdateApplication',
  'method' => 'PATCH',
  'path' => '/api/applications/{id}',
  'operation_id' => 'UpdateApplication',
  'summary' => 'Update application',
  'description' => 'Update application details by ID with the given data.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the application.',
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
