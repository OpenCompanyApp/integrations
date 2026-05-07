<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * patch System Configuration With Id.
 *
 * Maps to PATCH /api/system-configuration in the official FusionAuth OpenAPI document.
 */
class FusionAuthPatchSystemConfigurationWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_patch_system_configuration_with_id',
  'class' => 'FusionAuthPatchSystemConfigurationWithId',
  'method' => 'PATCH',
  'path' => '/api/system-configuration',
  'operation_id' => 'patchSystemConfigurationWithId',
  'summary' => 'patch System Configuration With Id',
  'description' => 'Updates, via PATCH, the system configuration.',
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
