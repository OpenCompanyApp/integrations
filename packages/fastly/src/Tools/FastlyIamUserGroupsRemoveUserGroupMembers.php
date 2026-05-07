<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Remove members of a user group
 *
 * Maps to Fastly generated client operation IamUserGroupsApi::removeUserGroupMembers (DELETE /user-groups/{user_group_id}/members).
 */
class FastlyIamUserGroupsRemoveUserGroupMembers extends AbstractFastlyTool
{
    protected const NAME = 'fastly_iam_user_groups_remove_user_group_members';
    protected const DESCRIPTION = 'Remove members of a user group

Official Fastly client operation: IamUserGroupsApi::removeUserGroupMembers
Endpoint: DELETE /user-groups/{user_group_id}/members

Remove members of a user group';
    protected const PARAMETERS = array (
  'user_group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `user_group_id`.',
  ),
  'request_body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'JSON request body matching the Fastly generated client parameter `request_body`.',
  ),
  'body' =>
  array (
    'type' => 'object',
    'required' => false,
    'description' => 'Alias for the JSON request body.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_iam_user_groups_remove_user_group_members',
  'class' => 'FastlyIamUserGroupsRemoveUserGroupMembers',
  'api_class' => 'IamUserGroupsApi',
  'method_name' => 'removeUserGroupMembers',
  'method' => 'DELETE',
  'path' => '/user-groups/{user_group_id}/members',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Remove members of a user group',
  'description' => 'Remove members of a user group',
  'type' => 'write',
  'parameters' =>
  array (
    'user_group_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `user_group_id`.',
    ),
    'request_body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'JSON request body matching the Fastly generated client parameter `request_body`.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Alias for the JSON request body.',
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
  'body_param' => 'request_body',
  'body_required' => false,
);
}
