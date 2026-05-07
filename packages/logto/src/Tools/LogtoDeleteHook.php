<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete hook.
 *
 * Maps to DELETE /api/hooks/{id} in the official Logto OpenAPI source.
 */
class LogtoDeleteHook extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_hook',
  'class' => 'LogtoDeleteHook',
  'method' => 'DELETE',
  'path' => '/api/hooks/{id}',
  'operation_id' => 'DeleteHook',
  'summary' => 'Delete hook',
  'description' => 'Delete hook by ID.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the hook.',
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
