<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve User Action.
 *
 * Maps to GET /api/user-action in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveUserAction extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_user_action',
  'class' => 'FusionAuthRetrieveUserAction',
  'method' => 'GET',
  'path' => '/api/user-action',
  'operation_id' => 'retrieveUserAction',
  'summary' => 'retrieve User Action',
  'description' => 'Retrieves the user action for the given Id. If you pass in null for the Id, this will return all the user actions. OR Retrieves all the user actions that are currently inactive.',
  'parameters' =>
  array (
    'tenant_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the tenant used to scope this API request. Only required when there is more than one tenant and the API key is not tenant-scoped.',
    ),
    'inactive' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official FusionAuth query parameter `inactive`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'inactive' => 'inactive',
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
