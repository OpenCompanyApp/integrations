<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * search Group Members With Id.
 *
 * Maps to POST /api/group/member/search in the official FusionAuth OpenAPI document.
 */
class FusionAuthSearchGroupMembersWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_search_group_members_with_id',
  'class' => 'FusionAuthSearchGroupMembersWithId',
  'method' => 'POST',
  'path' => '/api/group/member/search',
  'operation_id' => 'searchGroupMembersWithId',
  'summary' => 'search Group Members With Id',
  'description' => 'Searches group members with the specified criteria and pagination.',
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
