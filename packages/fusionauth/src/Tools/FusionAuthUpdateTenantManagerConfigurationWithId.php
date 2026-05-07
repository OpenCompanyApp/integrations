<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update Tenant Manager Configuration With Id.
 *
 * Maps to PUT /api/tenant-manager in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateTenantManagerConfigurationWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_tenant_manager_configuration_with_id',
  'class' => 'FusionAuthUpdateTenantManagerConfigurationWithId',
  'method' => 'PUT',
  'path' => '/api/tenant-manager',
  'operation_id' => 'updateTenantManagerConfigurationWithId',
  'summary' => 'update Tenant Manager Configuration With Id',
  'description' => 'Updates the Tenant Manager configuration.',
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
