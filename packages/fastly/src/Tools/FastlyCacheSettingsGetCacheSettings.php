<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a cache settings object
 *
 * Maps to Fastly generated client operation CacheSettingsApi::getCacheSettings (GET /service/{service_id}/version/{version_id}/cache_settings/{cache_settings_name}).
 */
class FastlyCacheSettingsGetCacheSettings extends AbstractFastlyTool
{
    protected const NAME = 'fastly_cache_settings_get_cache_settings';
    protected const DESCRIPTION = 'Get a cache settings object

Official Fastly client operation: CacheSettingsApi::getCacheSettings
Endpoint: GET /service/{service_id}/version/{version_id}/cache_settings/{cache_settings_name}

Get a cache settings object';
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
  'cache_settings_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `cache_settings_name`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_cache_settings_get_cache_settings',
  'class' => 'FastlyCacheSettingsGetCacheSettings',
  'api_class' => 'CacheSettingsApi',
  'method_name' => 'getCacheSettings',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/cache_settings/{cache_settings_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a cache settings object',
  'description' => 'Get a cache settings object',
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
    'cache_settings_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `cache_settings_name`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'cache_settings_name' => 'cache_settings_name',
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
