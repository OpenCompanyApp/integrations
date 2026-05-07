<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a Request Settings object
 *
 * Maps to Fastly generated client operation RequestSettingsApi::updateRequestSettings (PUT /service/{service_id}/version/{version_id}/request_settings/{request_settings_name}).
 */
class FastlyRequestSettingsUpdateRequestSettings extends AbstractFastlyTool
{
    protected const NAME = 'fastly_request_settings_update_request_settings';
    protected const DESCRIPTION = 'Update a Request Settings object

Official Fastly client operation: RequestSettingsApi::updateRequestSettings
Endpoint: PUT /service/{service_id}/version/{version_id}/request_settings/{request_settings_name}

Update a Request Settings object';
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
  'request_settings_name' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `request_settings_name`.',
  ),
  'action' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `action`.',
  ),
  'default_host' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `default_host`.',
  ),
  'hash_keys' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `hash_keys`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
  'request_condition' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `request_condition`.',
  ),
  'xff' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `xff`.',
  ),
  'bypass_busy_wait' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `bypass_busy_wait`.',
  ),
  'force_miss' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `force_miss`.',
  ),
  'force_ssl' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `force_ssl`.',
  ),
  'geo_headers' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `geo_headers`.',
  ),
  'max_stale_age' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `max_stale_age`.',
  ),
  'timer_support' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `timer_support`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_request_settings_update_request_settings',
  'class' => 'FastlyRequestSettingsUpdateRequestSettings',
  'api_class' => 'RequestSettingsApi',
  'method_name' => 'updateRequestSettings',
  'method' => 'PUT',
  'path' => '/service/{service_id}/version/{version_id}/request_settings/{request_settings_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a Request Settings object',
  'description' => 'Update a Request Settings object',
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
    'request_settings_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `request_settings_name`.',
    ),
    'action' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `action`.',
    ),
    'default_host' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `default_host`.',
    ),
    'hash_keys' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `hash_keys`.',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
    ),
    'request_condition' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `request_condition`.',
    ),
    'xff' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `xff`.',
    ),
    'bypass_busy_wait' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `bypass_busy_wait`.',
    ),
    'force_miss' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `force_miss`.',
    ),
    'force_ssl' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `force_ssl`.',
    ),
    'geo_headers' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `geo_headers`.',
    ),
    'max_stale_age' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `max_stale_age`.',
    ),
    'timer_support' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `timer_support`.',
    ),
  ),
  'path_params' =>
  array (
    'service_id' => 'service_id',
    'version_id' => 'version_id',
    'request_settings_name' => 'request_settings_name',
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
    'default_host' => 'default_host',
    'hash_keys' => 'hash_keys',
    'name' => 'name',
    'request_condition' => 'request_condition',
    'xff' => 'xff',
    'bypass_busy_wait' => 'bypass_busy_wait',
    'force_miss' => 'force_miss',
    'force_ssl' => 'force_ssl',
    'geo_headers' => 'geo_headers',
    'max_stale_age' => 'max_stale_age',
    'timer_support' => 'timer_support',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
