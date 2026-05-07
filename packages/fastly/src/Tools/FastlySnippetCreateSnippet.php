<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a snippet
 *
 * Maps to Fastly generated client operation SnippetApi::createSnippet (POST /service/{service_id}/version/{version_id}/snippet).
 */
class FastlySnippetCreateSnippet extends AbstractFastlyTool
{
    protected const NAME = 'fastly_snippet_create_snippet';
    protected const DESCRIPTION = 'Create a snippet

Official Fastly client operation: SnippetApi::createSnippet
Endpoint: POST /service/{service_id}/version/{version_id}/snippet

Create a snippet';
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
  'slug' => 'fastly_snippet_create_snippet',
  'class' => 'FastlySnippetCreateSnippet',
  'api_class' => 'SnippetApi',
  'method_name' => 'createSnippet',
  'method' => 'POST',
  'path' => '/service/{service_id}/version/{version_id}/snippet',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a snippet',
  'description' => 'Create a snippet',
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
