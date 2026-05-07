<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete Entity Grant With Id.
 *
 * Maps to DELETE /api/entity/{entityId}/grant in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteEntityGrantWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_entity_grant_with_id',
  'class' => 'FusionAuthDeleteEntityGrantWithId',
  'method' => 'DELETE',
  'path' => '/api/entity/{entityId}/grant',
  'operation_id' => 'deleteEntityGrantWithId',
  'summary' => 'delete Entity Grant With Id',
  'description' => 'Deletes an Entity Grant for the given User or Entity.',
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
      'description' => 'The Id of the Entity that the Entity Grant is being deleted for.',
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
  'type' => 'write',
);
}
