<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Test hook.
 *
 * Maps to POST /api/hooks/{id}/test in the official Logto OpenAPI source.
 */
class LogtoCreateHookTest extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_hook_test',
  'class' => 'LogtoCreateHookTest',
  'method' => 'POST',
  'path' => '/api/hooks/{id}/test',
  'operation_id' => 'CreateHookTest',
  'summary' => 'Test hook',
  'description' => 'Test the specified hook with the given events and config.',
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
