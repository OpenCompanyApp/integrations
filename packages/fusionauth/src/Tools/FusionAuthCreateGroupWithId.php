<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create Group With Id.
 *
 * Maps to POST /api/group/{groupId} in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateGroupWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_group_with_id',
  'class' => 'FusionAuthCreateGroupWithId',
  'method' => 'POST',
  'path' => '/api/group/{groupId}',
  'operation_id' => 'createGroupWithId',
  'summary' => 'create Group With Id',
  'description' => 'Creates a group. You can optionally specify an Id for the group, if not provided one will be generated.',
  'parameters' =>
  array (
    'group_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The Id for the group. If not provided a secure random UUID will be generated.',
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
