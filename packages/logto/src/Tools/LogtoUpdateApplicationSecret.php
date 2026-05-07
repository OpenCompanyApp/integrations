<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update application secret.
 *
 * Maps to PATCH /api/applications/{id}/secrets/{name} in the official Logto OpenAPI source.
 */
class LogtoUpdateApplicationSecret extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_application_secret',
  'class' => 'LogtoUpdateApplicationSecret',
  'method' => 'PATCH',
  'path' => '/api/applications/{id}/secrets/{name}',
  'operation_id' => 'UpdateApplicationSecret',
  'summary' => 'Update application secret',
  'description' => 'Update a secret for the application by name.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the application.',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The name of the secret.',
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
    'name' => 'name',
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
