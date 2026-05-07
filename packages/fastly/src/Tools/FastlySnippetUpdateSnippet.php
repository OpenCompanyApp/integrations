<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a versioned snippet
 *
 * Maps to Fastly generated client operation SnippetApi::updateSnippet (PUT /service/{service_id}/version/{version_id}/snippet/{name}).
 */
class FastlySnippetUpdateSnippet extends AbstractFastlyTool
{
    protected const NAME = 'fastly_snippet_update_snippet';
    protected const DESCRIPTION = 'Update a versioned snippet

Official Fastly client operation: SnippetApi::updateSnippet
Endpoint: PUT /service/{service_id}/version/{version_id}/snippet/{name}

Update a versioned snippet';
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
  'slug' => 'fastly_snippet_update_snippet',
  'class' => 'FastlySnippetUpdateSnippet',
  'api_class' => 'SnippetApi',
  'method_name' => 'updateSnippet',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/snippet/{name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a versioned snippet',
  'description' => 'Update a versioned snippet',
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
