<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create a hook.
 *
 * Maps to POST /api/hooks in the official Logto OpenAPI source.
 */
class LogtoCreateHook extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_hook',
  'class' => 'LogtoCreateHook',
  'method' => 'POST',
  'path' => '/api/hooks',
  'operation_id' => 'CreateHook',
  'summary' => 'Create a hook',
  'description' => 'Create a new hook with the given data.',
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
