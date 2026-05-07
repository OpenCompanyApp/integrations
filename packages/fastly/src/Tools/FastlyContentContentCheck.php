<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Check status of content in each POP's cache
 *
 * Maps to Fastly generated client operation ContentApi::contentCheck (GET /content/edge_check).
 */
class FastlyContentContentCheck extends AbstractFastlyTool
{
    protected const NAME = 'fastly_content_content_check';
    protected const DESCRIPTION = 'Check status of content in each POP\'s cache

Official Fastly client operation: ContentApi::contentCheck
Endpoint: GET /content/edge_check

Check status of content in each POP\'s cache';
    protected const PARAMETERS = array (
  'url' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `url`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_content_content_check',
  'class' => 'FastlyContentContentCheck',
  'api_class' => 'ContentApi',
  'method_name' => 'contentCheck',
  'method' => 'GET',
  'path' => '/content/edge_check',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Check status of content in each POP\'s cache',
  'description' => 'Check status of content in each POP\'s cache',
  'type' => 'read',
  'parameters' =>
  array (
    'url' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `url`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'url' => 'url',
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
