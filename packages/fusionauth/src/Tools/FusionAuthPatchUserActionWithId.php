<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * patch User Action With Id.
 *
 * Maps to PATCH /api/user-action/{userActionId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthPatchUserActionWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_patch_user_action_with_id',
  'class' => 'FusionAuthPatchUserActionWithId',
  'method' => 'PATCH',
  'path' => '/api/user-action/{userActionId}',
  'operation_id' => 'patchUserActionWithId',
  'summary' => 'patch User Action With Id',
  'description' => 'Updates, via PATCH, the user action with the given Id.',
  'parameters' =>
  array (
    'user_action_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the user action to update.',
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
    'userActionId' => 'user_action_id',
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
