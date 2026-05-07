<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update Group With Id.
 *
 * Maps to PUT /api/group/{groupId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateGroupWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_group_with_id',
  'class' => 'FusionAuthUpdateGroupWithId',
  'method' => 'PUT',
  'path' => '/api/group/{groupId}',
  'operation_id' => 'updateGroupWithId',
  'summary' => 'update Group With Id',
  'description' => 'Updates the group with the given Id.',
  'parameters' =>
  array (
    'group_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id of the group to update.',
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
  'content_type' => 'application/json',
  'type' => 'write',
);
}
