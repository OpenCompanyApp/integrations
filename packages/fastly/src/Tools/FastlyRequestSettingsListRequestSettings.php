<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List Request Settings objects
 *
 * Maps to Fastly generated client operation RequestSettingsApi::listRequestSettings (GET /service/{service_id}/version/{version_id}/request_settings).
 */
class FastlyRequestSettingsListRequestSettings extends AbstractFastlyTool
{
    protected const NAME = 'fastly_request_settings_list_request_settings';
    protected const DESCRIPTION = 'List Request Settings objects

Official Fastly client operation: RequestSettingsApi::listRequestSettings
Endpoint: GET /service/{service_id}/version/{version_id}/request_settings

List Request Settings objects';
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
  'slug' => 'fastly_request_settings_list_request_settings',
  'class' => 'FastlyRequestSettingsListRequestSettings',
  'api_class' => 'RequestSettingsApi',
  'method_name' => 'listRequestSettings',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/request_settings',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List Request Settings objects',
  'description' => 'List Request Settings objects',
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
