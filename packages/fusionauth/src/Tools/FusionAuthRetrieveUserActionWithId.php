<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve User Action With Id.
 *
 * Maps to GET /api/user-action/{userActionId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveUserActionWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_user_action_with_id',
  'class' => 'FusionAuthRetrieveUserActionWithId',
  'method' => 'GET',
  'path' => '/api/user-action/{userActionId}',
  'operation_id' => 'retrieveUserActionWithId',
  'summary' => 'retrieve User Action With Id',
  'description' => 'Retrieves the user action for the given Id. If you pass in null for the Id, this will return all the user actions.',
  'parameters' =>
  array (
    'user_action_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the user action.',
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
