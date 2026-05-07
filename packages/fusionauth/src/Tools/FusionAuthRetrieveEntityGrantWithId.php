<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Entity Grant With Id.
 *
 * Maps to GET /api/entity/{entityId}/grant in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveEntityGrantWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_entity_grant_with_id',
  'class' => 'FusionAuthRetrieveEntityGrantWithId',
  'method' => 'GET',
  'path' => '/api/entity/{entityId}/grant',
  'operation_id' => 'retrieveEntityGrantWithId',
  'summary' => 'retrieve Entity Grant With Id',
  'description' => 'Retrieves an Entity Grant for the given Entity and User/Entity.',
  'parameters' =>
  array (
    'recipient_entity_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The Id of the Entity that the Entity Grant is for.',
    ),
    'user_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The Id of the User that the Entity Grant is for.',
    ),
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
    'recipientEntityId' => 'recipient_entity_id',
    'userId' => 'user_id',
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
