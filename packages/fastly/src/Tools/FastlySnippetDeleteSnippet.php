<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a snippet
 *
 * Maps to Fastly generated client operation SnippetApi::deleteSnippet (DELETE /service/{service_id}/version/{version_id}/snippet/{name}).
 */
class FastlySnippetDeleteSnippet extends AbstractFastlyTool
{
    protected const NAME = 'fastly_snippet_delete_snippet';
    protected const DESCRIPTION = 'Delete a snippet

Official Fastly client operation: SnippetApi::deleteSnippet
Endpoint: DELETE /service/{service_id}/version/{version_id}/snippet/{name}

Delete a snippet';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'version_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `version_id`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_snippet_delete_snippet',
  'class' => 'FastlySnippetDeleteSnippet',
  'api_class' => 'SnippetApi',
  'method_name' => 'deleteSnippet',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/snippet/{name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a snippet',
  'description' => 'Delete a snippet',
  'type' => 'write',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'version_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `version_id`.',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'name' => 'name',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'form_params' =>
  array (
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
