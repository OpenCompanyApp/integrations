<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * patch User With Id.
 *
 * Maps to PATCH /api/user/{userId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthPatchUserWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_patch_user_with_id',
  'class' => 'FusionAuthPatchUserWithId',
  'method' => 'PATCH',
  'path' => '/api/user/{userId}',
  'operation_id' => 'patchUserWithId',
  'summary' => 'patch User With Id',
  'description' => 'Updates, via PATCH, the user with the given Id.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the user to update.',
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
    'userId' => 'user_id',
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
