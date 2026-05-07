<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * upsert Entity Grant With Id.
 *
 * Maps to POST /api/entity/{entityId}/grant in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpsertEntityGrantWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_upsert_entity_grant_with_id',
  'class' => 'FusionAuthUpsertEntityGrantWithId',
  'method' => 'POST',
  'path' => '/api/entity/{entityId}/grant',
  'operation_id' => 'upsertEntityGrantWithId',
  'summary' => 'upsert Entity Grant With Id',
  'description' => 'Creates or updates an Entity Grant. This is when a User/Entity is granted permissions to an Entity.',
  'parameters' =>
  array (
    'entity_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the Entity that the User/Entity is being granted access to.',
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
