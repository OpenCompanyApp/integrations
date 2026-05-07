<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete User Action With Id.
 *
 * Maps to DELETE /api/user-action/{userActionId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteUserActionWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_user_action_with_id',
  'class' => 'FusionAuthDeleteUserActionWithId',
  'method' => 'DELETE',
  'path' => '/api/user-action/{userActionId}',
  'operation_id' => 'deleteUserActionWithId',
  'summary' => 'delete User Action With Id',
  'description' => 'Deletes the user action for the given Id. This permanently deletes the user action and also any history and logs of the action being applied to any users. OR Deactivates the user action with the given Id.',
  'parameters' =>
  array (
    'hard_delete' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official FusionAuth query parameter `hardDelete`.',
    ),
    'user_action_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the user action to delete.',
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
    'userActionId' => 'user_action_id',
  ),
  'query_params' =>
  array (
    'hardDelete' => 'hard_delete',
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
