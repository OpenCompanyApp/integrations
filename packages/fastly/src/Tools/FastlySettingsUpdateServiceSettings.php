<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update service settings
 *
 * Maps to Fastly generated client operation SettingsApi::updateServiceSettings (PUT /service/{service_id}/version/{version_id}/settings).
 */
class FastlySettingsUpdateServiceSettings extends AbstractFastlyTool
{
    protected const NAME = 'fastly_settings_update_service_settings';
    protected const DESCRIPTION = 'Update service settings

Official Fastly client operation: SettingsApi::updateServiceSettings
Endpoint: PUT /service/{service_id}/version/{version_id}/settings

Update service settings';
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
  'general_default_host' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `general_default_host`.',
  ),
  'general_default_ttl' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `general_default_ttl`.',
  ),
  'general_stale_if_error' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `general_stale_if_error`.',
  ),
  'general_stale_if_error_ttl' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `general_stale_if_error_ttl`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_settings_update_service_settings',
  'class' => 'FastlySettingsUpdateServiceSettings',
  'api_class' => 'SettingsApi',
  'method_name' => 'updateServiceSettings',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/settings',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update service settings',
  'description' => 'Update service settings',
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
    'general_default_host' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `general_default_host`.',
    ),
    'general_default_ttl' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `general_default_ttl`.',
    ),
    'general_stale_if_error' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `general_stale_if_error`.',
    ),
    'general_stale_if_error_ttl' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `general_stale_if_error_ttl`.',
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
    'general.default_host' => 'general_default_host',
    'general.default_ttl' => 'general_default_ttl',
    'general.stale_if_error' => 'general_stale_if_error',
    'general.stale_if_error_ttl' => 'general_stale_if_error_ttl',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
