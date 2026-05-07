<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get application secrets.
 *
 * Maps to GET /api/applications/{id}/secrets in the official Logto OpenAPI source.
 */
class LogtoListApplicationSecrets extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_application_secrets',
  'class' => 'LogtoListApplicationSecrets',
  'method' => 'GET',
  'path' => '/api/applications/{id}/secrets',
  'operation_id' => 'ListApplicationSecrets',
  'summary' => 'Get application secrets',
  'description' => 'Get all the secrets for the application.',
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
