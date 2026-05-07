<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Tenant With Id.
 *
 * Maps to POST /api/tenant/{tenantId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateTenantWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_tenant_with_id',
  'class' => 'FusionAuthCreateTenantWithId',
  'method' => 'POST',
  'path' => '/api/tenant/{tenantId}',
  'operation_id' => 'createTenantWithId',
  'summary' => 'create Tenant With Id',
  'description' => 'Creates a tenant. You can optionally specify an Id for the tenant, if not provided one will be generated.',
  'parameters' =>
  array (
    'tenant_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the tenant used to scope this API request. Only required when there is more than one tenant and the API key is not tenant-scoped.',
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
    'tenantId' => 'tenant_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
    'X-FusionAuth-TenantId' => 'tenant_id',
  ),
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
