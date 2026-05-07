<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete secret.
 *
 * Maps to DELETE /api/secrets/{id} in the official Logto OpenAPI source.
 */
class LogtoDeleteSecret extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_secret',
  'class' => 'LogtoDeleteSecret',
  'method' => 'DELETE',
  'path' => '/api/secrets/{id}',
  'operation_id' => 'DeleteSecret',
  'summary' => 'Delete secret',
  'description' => 'Delete a secret by its ID.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the secret.',
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
