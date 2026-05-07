<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a cache settings object
 *
 * Maps to Fastly generated client operation CacheSettingsApi::createCacheSettings (POST /service/{service_id}/version/{version_id}/cache_settings).
 */
class FastlyCacheSettingsCreateCacheSettings extends AbstractFastlyTool
{
    protected const NAME = 'fastly_cache_settings_create_cache_settings';
    protected const DESCRIPTION = 'Create a cache settings object

Official Fastly client operation: CacheSettingsApi::createCacheSettings
Endpoint: POST /service/{service_id}/version/{version_id}/cache_settings

Create a cache settings object';
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
  'action' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `action`.',
  ),
  'cache_condition' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `cache_condition`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
  'stale_ttl' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `stale_ttl`.',
  ),
  'ttl' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `ttl`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_cache_settings_create_cache_settings',
  'class' => 'FastlyCacheSettingsCreateCacheSettings',
  'api_class' => 'CacheSettingsApi',
  'method_name' => 'createCacheSettings',
  'method' => 'POST',
  'path' => '/service/{service_id}/version/{version_id}/cache_settings',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a cache settings object',
  'description' => 'Create a cache settings object',
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
    'action' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `action`.',
    ),
    'cache_condition' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `cache_condition`.',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
    ),
    'stale_ttl' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `stale_ttl`.',
    ),
    'ttl' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `ttl`.',
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
    'action' => 'action',
    'cache_condition' => 'cache_condition',
    'name' => 'name',
    'stale_ttl' => 'stale_ttl',
    'ttl' => 'ttl',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
