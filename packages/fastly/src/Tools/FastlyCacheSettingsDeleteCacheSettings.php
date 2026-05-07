<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a cache settings object
 *
 * Maps to Fastly generated client operation CacheSettingsApi::deleteCacheSettings (DELETE /service/{service_id}/version/{version_id}/cache_settings/{cache_settings_name}).
 */
class FastlyCacheSettingsDeleteCacheSettings extends AbstractFastlyTool
{
    protected const NAME = 'fastly_cache_settings_delete_cache_settings';
    protected const DESCRIPTION = 'Delete a cache settings object

Official Fastly client operation: CacheSettingsApi::deleteCacheSettings
Endpoint: DELETE /service/{service_id}/version/{version_id}/cache_settings/{cache_settings_name}

Delete a cache settings object';
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
  'slug' => 'fastly_cache_settings_delete_cache_settings',
  'class' => 'FastlyCacheSettingsDeleteCacheSettings',
  'api_class' => 'CacheSettingsApi',
  'method_name' => 'deleteCacheSettings',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/cache_settings/{cache_settings_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a cache settings object',
  'description' => 'Delete a cache settings object',
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
