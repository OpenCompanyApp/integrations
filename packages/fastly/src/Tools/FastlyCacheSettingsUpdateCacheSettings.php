<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a cache settings object
 *
 * Maps to Fastly generated client operation CacheSettingsApi::updateCacheSettings (PUT /service/{service_id}/version/{version_id}/cache_settings/{cache_settings_name}).
 */
class FastlyCacheSettingsUpdateCacheSettings extends AbstractFastlyTool
{
    protected const NAME = 'fastly_cache_settings_update_cache_settings';
    protected const DESCRIPTION = 'Update a cache settings object

Official Fastly client operation: CacheSettingsApi::updateCacheSettings
Endpoint: PUT /service/{service_id}/version/{version_id}/cache_settings/{cache_settings_name}

Update a cache settings object';
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
  'slug' => 'fastly_cache_settings_update_cache_settings',
  'class' => 'FastlyCacheSettingsUpdateCacheSettings',
  'api_class' => 'CacheSettingsApi',
  'method_name' => 'updateCacheSettings',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/cache_settings/{cache_settings_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a cache settings object',
  'description' => 'Update a cache settings object',
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
    'cache_settings_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `cache_settings_name`.',
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
