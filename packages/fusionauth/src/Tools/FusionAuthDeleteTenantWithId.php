<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete Tenant With Id.
 *
 * Maps to DELETE /api/tenant/{tenantId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteTenantWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_tenant_with_id',
  'class' => 'FusionAuthDeleteTenantWithId',
  'method' => 'DELETE',
  'path' => '/api/tenant/{tenantId}',
  'operation_id' => 'deleteTenantWithId',
  'summary' => 'delete Tenant With Id',
  'description' => 'Deletes the tenant based on the given request (sent to the API as JSON). This permanently deletes all information, metrics, reports and data associated with the tenant and everything under the tenant (applications, users, etc). OR Deletes the tenant for the given Id asynchronously. This method is helpful if you do not want to wait for the delete operation to complete. OR Deletes the tenant based on the given Id on the URL. This permanently deletes all information, metrics, reports and data assoc',
  'parameters' =>
  array (
    'tenant_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the tenant used to scope this API request. Only required when there is more than one tenant and the API key is not tenant-scoped.',
    ),
    'async' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official FusionAuth query parameter `async`.',
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
    'async' => 'async',
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
