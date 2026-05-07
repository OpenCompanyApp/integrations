<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update hook.
 *
 * Maps to PATCH /api/hooks/{id} in the official Logto OpenAPI source.
 */
class LogtoUpdateHook extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_hook',
  'class' => 'LogtoUpdateHook',
  'method' => 'PATCH',
  'path' => '/api/hooks/{id}',
  'operation_id' => 'UpdateHook',
  'summary' => 'Update hook',
  'description' => 'Update hook details by ID with the given data.',
  'parameters' =>
  array (
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the hook.',
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
