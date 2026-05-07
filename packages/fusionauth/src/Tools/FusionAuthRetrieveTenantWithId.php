<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Tenant With Id.
 *
 * Maps to GET /api/tenant/{tenantId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveTenantWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_tenant_with_id',
  'class' => 'FusionAuthRetrieveTenantWithId',
  'method' => 'GET',
  'path' => '/api/tenant/{tenantId}',
  'operation_id' => 'retrieveTenantWithId',
  'summary' => 'retrieve Tenant With Id',
  'description' => 'Retrieves the tenant for the given Id.',
  'parameters' =>
  array (
    'tenant_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the tenant used to scope this API request. Only required when there is more than one tenant and the API key is not tenant-scoped.',
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
  'content_type' => NULL,
  'type' => 'read',
);
}
