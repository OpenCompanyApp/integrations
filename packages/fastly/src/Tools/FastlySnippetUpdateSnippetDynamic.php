<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a dynamic snippet
 *
 * Maps to Fastly generated client operation SnippetApi::updateSnippetDynamic (PUT /service/{service_id}/snippet/{id}).
 */
class FastlySnippetUpdateSnippetDynamic extends AbstractFastlyTool
{
    protected const NAME = 'fastly_snippet_update_snippet_dynamic';
    protected const DESCRIPTION = 'Update a dynamic snippet

Official Fastly client operation: SnippetApi::updateSnippetDynamic
Endpoint: PUT /service/{service_id}/snippet/{id}

Update a dynamic snippet';
    protected const PARAMETERS = array (
  'service_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `service_id`.',
  ),
  'id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `id`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
  'type' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `type`.',
  ),
  'content' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `content`.',
  ),
  'priority' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `priority`.',
  ),
  'dynamic' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `dynamic`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_snippet_update_snippet_dynamic',
  'class' => 'FastlySnippetUpdateSnippetDynamic',
  'api_class' => 'SnippetApi',
  'method_name' => 'updateSnippetDynamic',
  'method' => 'PUT',
  'path' => '/service/{service_id}/snippet/{id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a dynamic snippet',
  'description' => 'Update a dynamic snippet',
  'type' => 'write',
  'parameters' =>
  array (
    'service_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `service_id`.',
    ),
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `id`.',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
    ),
    'type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `type`.',
    ),
    'content' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `content`.',
    ),
    'priority' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `priority`.',
    ),
    'dynamic' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `dynamic`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'id' => 'id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'form_params' =>
  array (
    'name' => 'name',
    'type' => 'type',
    'content' => 'content',
    'priority' => 'priority',
    'dynamic' => 'dynamic',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
