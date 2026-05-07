<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete Entity With Id.
 *
 * Maps to DELETE /api/entity/{entityId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteEntityWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_entity_with_id',
  'class' => 'FusionAuthDeleteEntityWithId',
  'method' => 'DELETE',
  'path' => '/api/entity/{entityId}',
  'operation_id' => 'deleteEntityWithId',
  'summary' => 'delete Entity With Id',
  'description' => 'Deletes the Entity for the given Id.',
  'parameters' =>
  array (
    'entity_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the Entity to delete.',
    ),
    'tenant_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the tenant used to scope this API request. Only required when there is more than one tenant and the API key is not tenant-scoped.',
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
  'content_type' => NULL,
  'type' => 'write',
);
}
