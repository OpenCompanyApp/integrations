<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update Group Members With Id.
 *
 * Maps to PUT /api/group/member in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateGroupMembersWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_group_members_with_id',
  'class' => 'FusionAuthUpdateGroupMembersWithId',
  'method' => 'PUT',
  'path' => '/api/group/member',
  'operation_id' => 'updateGroupMembersWithId',
  'summary' => 'update Group Members With Id',
  'description' => 'Creates a member in a group.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
