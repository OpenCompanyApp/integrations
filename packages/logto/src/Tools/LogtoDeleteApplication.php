<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete application.
 *
 * Maps to DELETE /api/applications/{id} in the official Logto OpenAPI source.
 */
class LogtoDeleteApplication extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_application',
  'class' => 'LogtoDeleteApplication',
  'method' => 'DELETE',
  'path' => '/api/applications/{id}',
  'operation_id' => 'DeleteApplication',
  'summary' => 'Delete application',
  'description' => 'Delete application by ID.',
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
  'type' => 'write',
);
}
