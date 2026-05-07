<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete application secret.
 *
 * Maps to DELETE /api/applications/{id}/secrets/{name} in the official Logto OpenAPI source.
 */
class LogtoDeleteApplicationSecret extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_application_secret',
  'class' => 'LogtoDeleteApplicationSecret',
  'method' => 'DELETE',
  'path' => '/api/applications/{id}/secrets/{name}',
  'operation_id' => 'DeleteApplicationSecret',
  'summary' => 'Delete application secret',
  'description' => 'Delete a secret for the application by name.',
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
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
