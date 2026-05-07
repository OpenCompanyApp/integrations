<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve User With Id.
 *
 * Maps to GET /api/user/{userId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveUserWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_user_with_id',
  'class' => 'FusionAuthRetrieveUserWithId',
  'method' => 'GET',
  'path' => '/api/user/{userId}',
  'operation_id' => 'retrieveUserWithId',
  'summary' => 'retrieve User With Id',
  'description' => 'Retrieves the user for the given Id.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the user.',
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
  'content_type' => NULL,
  'type' => 'read',
);
}
