<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update Entity With Id.
 *
 * Maps to PUT /api/entity/{entityId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateEntityWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_entity_with_id',
  'class' => 'FusionAuthUpdateEntityWithId',
  'method' => 'PUT',
  'path' => '/api/entity/{entityId}',
  'operation_id' => 'updateEntityWithId',
  'summary' => 'update Entity With Id',
  'description' => 'Updates the Entity with the given Id.',
  'parameters' =>
  array (
    'entity_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the Entity to update.',
    ),
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
    'entityId' => 'entity_id',
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
