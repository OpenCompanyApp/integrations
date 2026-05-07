<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Purge a URL
 *
 * Maps to Fastly generated client operation PurgeApi::purgeSingleUrl (POST /purge/{cached_url}).
 */
class FastlyPurgePurgeSingleUrl extends AbstractFastlyTool
{
    protected const NAME = 'fastly_purge_purge_single_url';
    protected const DESCRIPTION = 'Purge a URL

Official Fastly client operation: PurgeApi::purgeSingleUrl
Endpoint: POST /purge/{cached_url}

Purge a URL';
    protected const PARAMETERS = array (
  'fastly_soft_purge' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `fastly_soft_purge`.',
  ),
  'cached_url' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `cached_url`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_purge_purge_single_url',
  'class' => 'FastlyPurgePurgeSingleUrl',
  'api_class' => 'PurgeApi',
  'method_name' => 'purgeSingleUrl',
  'method' => 'POST',
  'path' => '/purge/{cached_url}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Purge a URL',
  'description' => 'Purge a URL',
  'type' => 'write',
  'parameters' =>
  array (
    'fastly_soft_purge' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `fastly_soft_purge`.',
    ),
    'cached_url' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `cached_url`.',
    ),
  ),
  'path_params' =>
  array (
    'cached_url' => 'cached_url',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
    'fastly-soft-purge' => 'fastly_soft_purge',
  ),
  'form_params' =>
  array (
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
