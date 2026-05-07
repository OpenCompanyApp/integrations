<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * patch Tenant Manager Configuration With Id.
 *
 * Maps to PATCH /api/tenant-manager in the official FusionAuth OpenAPI document.
 */
class FusionAuthPatchTenantManagerConfigurationWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_patch_tenant_manager_configuration_with_id',
  'class' => 'FusionAuthPatchTenantManagerConfigurationWithId',
  'method' => 'PATCH',
  'path' => '/api/tenant-manager',
  'operation_id' => 'patchTenantManagerConfigurationWithId',
  'summary' => 'patch Tenant Manager Configuration With Id',
  'description' => 'Updates, via PATCH, the Tenant Manager configuration.',
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
