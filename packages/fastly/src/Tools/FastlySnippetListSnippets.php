<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List snippets
 *
 * Maps to Fastly generated client operation SnippetApi::listSnippets (GET /service/{service_id}/version/{version_id}/snippet).
 */
class FastlySnippetListSnippets extends AbstractFastlyTool
{
    protected const NAME = 'fastly_snippet_list_snippets';
    protected const DESCRIPTION = 'List snippets

Official Fastly client operation: SnippetApi::listSnippets
Endpoint: GET /service/{service_id}/version/{version_id}/snippet

List snippets';
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
);
    protected const OPERATION = array (
  'slug' => 'fastly_snippet_list_snippets',
  'class' => 'FastlySnippetListSnippets',
  'api_class' => 'SnippetApi',
  'method_name' => 'listSnippets',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/snippet',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List snippets',
  'description' => 'List snippets',
  'type' => 'read',
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
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
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
