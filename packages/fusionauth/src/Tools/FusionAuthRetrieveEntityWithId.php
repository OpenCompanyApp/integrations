<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Entity With Id.
 *
 * Maps to GET /api/entity/{entityId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveEntityWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_entity_with_id',
  'class' => 'FusionAuthRetrieveEntityWithId',
  'method' => 'GET',
  'path' => '/api/entity/{entityId}',
  'operation_id' => 'retrieveEntityWithId',
  'summary' => 'retrieve Entity With Id',
  'description' => 'Retrieves the Entity for the given Id.',
  'parameters' =>
  array (
    'entity_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the Entity.',
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
  'type' => 'read',
);
}
