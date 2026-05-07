<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a Request Settings object
 *
 * Maps to Fastly generated client operation RequestSettingsApi::deleteRequestSettings (DELETE /service/{service_id}/version/{version_id}/request_settings/{request_settings_name}).
 */
class FastlyRequestSettingsDeleteRequestSettings extends AbstractFastlyTool
{
    protected const NAME = 'fastly_request_settings_delete_request_settings';
    protected const DESCRIPTION = 'Delete a Request Settings object

Official Fastly client operation: RequestSettingsApi::deleteRequestSettings
Endpoint: DELETE /service/{service_id}/version/{version_id}/request_settings/{request_settings_name}

Delete a Request Settings object';
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
  'slug' => 'fastly_request_settings_delete_request_settings',
  'class' => 'FastlyRequestSettingsDeleteRequestSettings',
  'api_class' => 'RequestSettingsApi',
  'method_name' => 'deleteRequestSettings',
  'method' => 'DELETE',
  'path' => '/service/{service_id}/version/{version_id}/request_settings/{request_settings_name}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a Request Settings object',
  'description' => 'Delete a Request Settings object',
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
