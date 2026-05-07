<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a versioned snippet
 *
 * Maps to Fastly generated client operation SnippetApi::getSnippet (GET /service/{service_id}/version/{version_id}/snippet/{name}).
 */
class FastlySnippetGetSnippet extends AbstractFastlyTool
{
    protected const NAME = 'fastly_snippet_get_snippet';
    protected const DESCRIPTION = 'Get a versioned snippet

Official Fastly client operation: SnippetApi::getSnippet
Endpoint: GET /service/{service_id}/version/{version_id}/snippet/{name}

Get a versioned snippet';
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
  'slug' => 'fastly_snippet_get_snippet',
  'class' => 'FastlySnippetGetSnippet',
  'api_class' => 'SnippetApi',
  'method_name' => 'getSnippet',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/snippet/{name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a versioned snippet',
  'description' => 'Get a versioned snippet',
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
