<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * delete User Bulk.
 *
 * Maps to DELETE /api/user/bulk in the official FusionAuth OpenAPI document.
 */
class FusionAuthDeleteUserBulk extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_delete_user_bulk',
  'class' => 'FusionAuthDeleteUserBulk',
  'method' => 'DELETE',
  'path' => '/api/user/bulk',
  'operation_id' => 'deleteUserBulk',
  'summary' => 'delete User Bulk',
  'description' => 'Deletes the users with the given Ids, or users matching the provided JSON query or queryString. The order of preference is Ids, query and then queryString, it is recommended to only provide one of the three for the request. This method can be used to deactivate or permanently delete (hard-delete) users based upon the hardDelete boolean in the request body. Using the dryRun parameter you may also request the result of the action without actually deleting or deactivating any users. OR Deactivates ',
  'parameters' =>
  array (
    'user_ids' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The ids of the users to deactivate.',
    ),
    'dry_run' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official FusionAuth query parameter `dryRun`.',
    ),
    'hard_delete' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official FusionAuth query parameter `hardDelete`.',
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
  ),
  'query_params' =>
  array (
    'userIds' => 'user_ids',
    'dryRun' => 'dry_run',
    'hardDelete' => 'hard_delete',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
