<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create User Action With Id.
 *
 * Maps to POST /api/user-action/{userActionId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateUserActionWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_user_action_with_id',
  'class' => 'FusionAuthCreateUserActionWithId',
  'method' => 'POST',
  'path' => '/api/user-action/{userActionId}',
  'operation_id' => 'createUserActionWithId',
  'summary' => 'create User Action With Id',
  'description' => 'Creates a user action. This action cannot be taken on a user until this call successfully returns. Anytime after that the user action can be applied to any user.',
  'parameters' =>
  array (
    'user_action_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id for the user action. If not provided a secure random UUID will be generated.',
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
