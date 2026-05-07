<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get current Image Optimizer Default Settings
 *
 * Maps to Fastly generated client operation ImageOptimizerDefaultSettingsApi::getDefaultSettings (GET /service/{service_id}/version/{version_id}/image_optimizer_default_settings).
 */
class FastlyImageOptimizerDefaultSettingsGetDefaultSettings extends AbstractFastlyTool
{
    protected const NAME = 'fastly_image_optimizer_default_settings_get_default_settings';
    protected const DESCRIPTION = 'Get current Image Optimizer Default Settings

Official Fastly client operation: ImageOptimizerDefaultSettingsApi::getDefaultSettings
Endpoint: GET /service/{service_id}/version/{version_id}/image_optimizer_default_settings

Get current Image Optimizer Default Settings';
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
  'slug' => 'fastly_image_optimizer_default_settings_get_default_settings',
  'class' => 'FastlyImageOptimizerDefaultSettingsGetDefaultSettings',
  'api_class' => 'ImageOptimizerDefaultSettingsApi',
  'method_name' => 'getDefaultSettings',
  'method' => 'GET',
  'path' => '/service/{service_id}/version/{version_id}/image_optimizer_default_settings',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get current Image Optimizer Default Settings',
  'description' => 'Get current Image Optimizer Default Settings',
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
