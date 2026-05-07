<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * patch Tenant Manager Identity Provider Type Configuration With Id.
 *
 * Maps to PATCH /api/tenant-manager/identity-provider/{type} in the official FusionAuth OpenAPI document.
 */
class FusionAuthPatchTenantManagerIdentityProviderTypeConfigurationWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_patch_tenant_manager_identity_provider_type_configuration_with_id',
  'class' => 'FusionAuthPatchTenantManagerIdentityProviderTypeConfigurationWithId',
  'method' => 'PATCH',
  'path' => '/api/tenant-manager/identity-provider/{type}',
  'operation_id' => 'patchTenantManagerIdentityProviderTypeConfigurationWithId',
  'summary' => 'patch Tenant Manager Identity Provider Type Configuration With Id',
  'description' => 'Patches the tenant manager identity provider type configuration for the given identity provider type.',
  'parameters' =>
  array (
    'type' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The type of the identity provider.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
    'type' => 'type',
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
