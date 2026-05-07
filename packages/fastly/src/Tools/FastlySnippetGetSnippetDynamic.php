<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a dynamic snippet
 *
 * Maps to Fastly generated client operation SnippetApi::getSnippetDynamic (GET /service/{service_id}/snippet/{id}).
 */
class FastlySnippetGetSnippetDynamic extends AbstractFastlyTool
{
    protected const NAME = 'fastly_snippet_get_snippet_dynamic';
    protected const DESCRIPTION = 'Get a dynamic snippet

Official Fastly client operation: SnippetApi::getSnippetDynamic
Endpoint: GET /service/{service_id}/snippet/{id}

Get a dynamic snippet';
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
);
    protected const OPERATION = array (
  'slug' => 'fastly_snippet_get_snippet_dynamic',
  'class' => 'FastlySnippetGetSnippetDynamic',
  'api_class' => 'SnippetApi',
  'method_name' => 'getSnippetDynamic',
  'method' => 'GET',
  'path' => '/service/{service_id}/snippet/{id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a dynamic snippet',
  'description' => 'Get a dynamic snippet',
  'type' => 'read',
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
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
