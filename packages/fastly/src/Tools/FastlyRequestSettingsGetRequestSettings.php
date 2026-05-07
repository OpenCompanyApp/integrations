<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a Request Settings object
 *
 * Maps to Fastly generated client operation RequestSettingsApi::getRequestSettings (GET /service/{service_id}/version/{version_id}/request_settings/{request_settings_name}).
 */
class FastlyRequestSettingsGetRequestSettings extends AbstractFastlyTool
{
    protected const NAME = 'fastly_request_settings_get_request_settings';
    protected const DESCRIPTION = 'Get a Request Settings object

Official Fastly client operation: RequestSettingsApi::getRequestSettings
Endpoint: GET /service/{service_id}/version/{version_id}/request_settings/{request_settings_name}

Get a Request Settings object';
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
);
    protected const OPERATION = array (
  'slug' => 'fastly_request_settings_get_request_settings',
  'class' => 'FastlyRequestSettingsGetRequestSettings',
  'api_class' => 'RequestSettingsApi',
  'method_name' => 'getRequestSettings',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/request_settings/{request_settings_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a Request Settings object',
  'description' => 'Get a Request Settings object',
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
    'request_settings_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `request_settings_name`.',
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
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
