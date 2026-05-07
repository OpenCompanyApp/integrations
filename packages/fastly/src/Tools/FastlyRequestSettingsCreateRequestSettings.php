<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a Request Settings object
 *
 * Maps to Fastly generated client operation RequestSettingsApi::createRequestSettings (POST /service/{service_id}/version/{version_id}/request_settings).
 */
class FastlyRequestSettingsCreateRequestSettings extends AbstractFastlyTool
{
    protected const NAME = 'fastly_request_settings_create_request_settings';
    protected const DESCRIPTION = 'Create a Request Settings object

Official Fastly client operation: RequestSettingsApi::createRequestSettings
Endpoint: POST /service/{service_id}/version/{version_id}/request_settings

Create a Request Settings object';
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
  'slug' => 'fastly_request_settings_create_request_settings',
  'class' => 'FastlyRequestSettingsCreateRequestSettings',
  'api_class' => 'RequestSettingsApi',
  'method_name' => 'createRequestSettings',
  'method' => 'POST',
  'path' => '/service/{service_id}/version/{version_id}/request_settings',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a Request Settings object',
  'description' => 'Create a Request Settings object',
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
