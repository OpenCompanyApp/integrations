<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update System Configuration With Id.
 *
 * Maps to PUT /api/system-configuration in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateSystemConfigurationWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_system_configuration_with_id',
  'class' => 'FusionAuthUpdateSystemConfigurationWithId',
  'method' => 'PUT',
  'path' => '/api/system-configuration',
  'operation_id' => 'updateSystemConfigurationWithId',
  'summary' => 'update System Configuration With Id',
  'description' => 'Updates the system configuration.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
