<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Entity With Id.
 *
 * Maps to POST /api/entity/{entityId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateEntityWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_entity_with_id',
  'class' => 'FusionAuthCreateEntityWithId',
  'method' => 'POST',
  'path' => '/api/entity/{entityId}',
  'operation_id' => 'createEntityWithId',
  'summary' => 'create Entity With Id',
  'description' => 'Creates an Entity. You can optionally specify an Id for the Entity. If not provided one will be generated.',
  'parameters' =>
  array (
    'entity_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id for the Entity. If not provided a secure random UUID will be generated.',
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
