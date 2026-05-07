<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete Tenant Manager Identity Provider Type Configuration With Id.
 *
 * Maps to DELETE /api/tenant-manager/identity-provider/{type} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteTenantManagerIdentityProviderTypeConfigurationWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_tenant_manager_identity_provider_type_configuration_with_id',
  'class' => 'FusionAuthDeleteTenantManagerIdentityProviderTypeConfigurationWithId',
  'method' => 'DELETE',
  'path' => '/api/tenant-manager/identity-provider/{type}',
  'operation_id' => 'deleteTenantManagerIdentityProviderTypeConfigurationWithId',
  'summary' => 'delete Tenant Manager Identity Provider Type Configuration With Id',
  'description' => 'Deletes the tenant manager identity provider type configuration for the given identity provider type.',
  'parameters' =>
  array (
    'type' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The type of the identity provider.',
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
  'content_type' => NULL,
  'type' => 'write',
);
}
