<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update User Action With Id.
 *
 * Maps to PUT /api/user-action/{userActionId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateUserActionWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_user_action_with_id',
  'class' => 'FusionAuthUpdateUserActionWithId',
  'method' => 'PUT',
  'path' => '/api/user-action/{userActionId}',
  'operation_id' => 'updateUserActionWithId',
  'summary' => 'update User Action With Id',
  'description' => 'Updates the user action with the given Id. OR Reactivates the user action with the given Id.',
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
    'reactivate' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official FusionAuth query parameter `reactivate`.',
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
    'reactivate' => 'reactivate',
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
