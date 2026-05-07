<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update Image Optimizer Default Settings
 *
 * Maps to Fastly generated client operation ImageOptimizerDefaultSettingsApi::updateDefaultSettings (PATCH /service/{service_id}/version/{version_id}/image_optimizer_default_settings).
 */
class FastlyImageOptimizerDefaultSettingsUpdateDefaultSettings extends AbstractFastlyTool
{
    protected const NAME = 'fastly_image_optimizer_default_settings_update_default_settings';
    protected const DESCRIPTION = 'Update Image Optimizer Default Settings

Official Fastly client operation: ImageOptimizerDefaultSettingsApi::updateDefaultSettings
Endpoint: PATCH /service/{service_id}/version/{version_id}/image_optimizer_default_settings

Update Image Optimizer Default Settings';
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
  'default_settings' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `default_settings`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_image_optimizer_default_settings_update_default_settings',
  'class' => 'FastlyImageOptimizerDefaultSettingsUpdateDefaultSettings',
  'api_class' => 'ImageOptimizerDefaultSettingsApi',
  'method_name' => 'updateDefaultSettings',
  'method' => 'PATCH',
  'path' => '/service/{service_id}/version/{version_id}/image_optimizer_default_settings',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update Image Optimizer Default Settings',
  'description' => 'Update Image Optimizer Default Settings',
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
    'default_settings' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `default_settings`.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Alias for the JSON request body.',
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
  'body_param' => 'default_settings',
  'body_required' => false,
);
}
