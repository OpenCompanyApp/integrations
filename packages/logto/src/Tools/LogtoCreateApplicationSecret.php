<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Add application secret.
 *
 * Maps to POST /api/applications/{id}/secrets in the official Logto OpenAPI source.
 */
class LogtoCreateApplicationSecret extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_application_secret',
  'class' => 'LogtoCreateApplicationSecret',
  'method' => 'POST',
  'path' => '/api/applications/{id}/secrets',
  'operation_id' => 'CreateApplicationSecret',
  'summary' => 'Add application secret',
  'description' => 'Add a new secret for the application.',
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
