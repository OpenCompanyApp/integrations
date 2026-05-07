<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete Group Members With Id.
 *
 * Maps to DELETE /api/group/member in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteGroupMembersWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_group_members_with_id',
  'class' => 'FusionAuthDeleteGroupMembersWithId',
  'method' => 'DELETE',
  'path' => '/api/group/member',
  'operation_id' => 'deleteGroupMembersWithId',
  'summary' => 'delete Group Members With Id',
  'description' => 'Removes users as members of a group.',
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
