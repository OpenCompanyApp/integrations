<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve Group With Id.
 *
 * Maps to GET /api/group/{groupId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveGroupWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_group_with_id',
  'class' => 'FusionAuthRetrieveGroupWithId',
  'method' => 'GET',
  'path' => '/api/group/{groupId}',
  'operation_id' => 'retrieveGroupWithId',
  'summary' => 'retrieve Group With Id',
  'description' => 'Retrieves the group for the given Id.',
  'parameters' =>
  array (
    'group_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the group.',
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
    'groupId' => 'group_id',
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
