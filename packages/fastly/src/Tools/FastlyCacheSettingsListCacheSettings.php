<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List cache settings objects
 *
 * Maps to Fastly generated client operation CacheSettingsApi::listCacheSettings (GET /service/{service_id}/version/{version_id}/cache_settings).
 */
class FastlyCacheSettingsListCacheSettings extends AbstractFastlyTool
{
    protected const NAME = 'fastly_cache_settings_list_cache_settings';
    protected const DESCRIPTION = 'List cache settings objects

Official Fastly client operation: CacheSettingsApi::listCacheSettings
Endpoint: GET /service/{service_id}/version/{version_id}/cache_settings

List cache settings objects';
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
);
    protected const OPERATION = array (
  'slug' => 'fastly_cache_settings_list_cache_settings',
  'class' => 'FastlyCacheSettingsListCacheSettings',
  'api_class' => 'CacheSettingsApi',
  'method_name' => 'listCacheSettings',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/cache_settings',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List cache settings objects',
  'description' => 'List cache settings objects',
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
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
