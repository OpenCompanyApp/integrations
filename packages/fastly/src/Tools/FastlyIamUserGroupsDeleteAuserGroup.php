<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a user group
 *
 * Maps to Fastly generated client operation IamUserGroupsApi::deleteAUserGroup (DELETE /user-groups/{user_group_id}).
 */
class FastlyIamUserGroupsDeleteAuserGroup extends AbstractFastlyTool
{
    protected const NAME = 'fastly_iam_user_groups_delete_auser_group';
    protected const DESCRIPTION = 'Delete a user group

Official Fastly client operation: IamUserGroupsApi::deleteAUserGroup
Endpoint: DELETE /user-groups/{user_group_id}

Delete a user group';
    protected const PARAMETERS = array (
  'user_group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `user_group_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_iam_user_groups_delete_auser_group',
  'class' => 'FastlyIamUserGroupsDeleteAuserGroup',
  'api_class' => 'IamUserGroupsApi',
  'method_name' => 'deleteAUserGroup',
  'method' => 'DELETE',
  'path' => '/user-groups/{user_group_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a user group',
  'description' => 'Delete a user group',
  'type' => 'write',
  'parameters' =>
  array (
    'user_group_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `user_group_id`.',
    ),
  ),
  'path_params' =>
  array (
    'user_group_id' => 'user_group_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'form_params' =>
  array (
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
