<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get service settings
 *
 * Maps to Fastly generated client operation SettingsApi::getServiceSettings (GET /service/{service_id}/version/{version_id}/settings).
 */
class FastlySettingsGetServiceSettings extends AbstractFastlyTool
{
    protected const NAME = 'fastly_settings_get_service_settings';
    protected const DESCRIPTION = 'Get service settings

Official Fastly client operation: SettingsApi::getServiceSettings
Endpoint: GET /service/{service_id}/version/{version_id}/settings

Get service settings';
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
  'slug' => 'fastly_settings_get_service_settings',
  'class' => 'FastlySettingsGetServiceSettings',
  'api_class' => 'SettingsApi',
  'method_name' => 'getServiceSettings',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/settings',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get service settings',
  'description' => 'Get service settings',
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
