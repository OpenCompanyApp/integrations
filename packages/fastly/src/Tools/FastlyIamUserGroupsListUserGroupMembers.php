<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List members of a user group
 *
 * Maps to Fastly generated client operation IamUserGroupsApi::listUserGroupMembers (GET /user-groups/{user_group_id}/members).
 */
class FastlyIamUserGroupsListUserGroupMembers extends AbstractFastlyTool
{
    protected const NAME = 'fastly_iam_user_groups_list_user_group_members';
    protected const DESCRIPTION = 'List members of a user group

Official Fastly client operation: IamUserGroupsApi::listUserGroupMembers
Endpoint: GET /user-groups/{user_group_id}/members

List members of a user group';
    protected const PARAMETERS = array (
  'user_group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `user_group_id`.',
  ),
  'per_page' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `per_page`.',
  ),
  'page' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `page`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_iam_user_groups_list_user_group_members',
  'class' => 'FastlyIamUserGroupsListUserGroupMembers',
  'api_class' => 'IamUserGroupsApi',
  'method_name' => 'listUserGroupMembers',
  'method' => 'GET',
  'path' => '/user-groups/{user_group_id}/members',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List members of a user group',
  'description' => 'List members of a user group',
  'type' => 'read',
  'parameters' =>
  array (
    'user_group_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `user_group_id`.',
    ),
    'per_page' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `per_page`.',
    ),
    'page' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `page`.',
    ),
  ),
  'path_params' =>
  array (
    'user_group_id' => 'user_group_id',
  ),
  'query_params' =>
  array (
    'per_page' => 'per_page',
    'page' => 'page',
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
