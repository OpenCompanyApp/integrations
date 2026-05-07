<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List roles in a user group
 *
 * Maps to Fastly generated client operation IamUserGroupsApi::listUserGroupRoles (GET /user-groups/{user_group_id}/roles).
 */
class FastlyIamUserGroupsListUserGroupRoles extends AbstractFastlyTool
{
    protected const NAME = 'fastly_iam_user_groups_list_user_group_roles';
    protected const DESCRIPTION = 'List roles in a user group

Official Fastly client operation: IamUserGroupsApi::listUserGroupRoles
Endpoint: GET /user-groups/{user_group_id}/roles

List roles in a user group';
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
  'slug' => 'fastly_iam_user_groups_list_user_group_roles',
  'class' => 'FastlyIamUserGroupsListUserGroupRoles',
  'api_class' => 'IamUserGroupsApi',
  'method_name' => 'listUserGroupRoles',
  'method' => 'GET',
  'path' => '/user-groups/{user_group_id}/roles',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List roles in a user group',
  'description' => 'List roles in a user group',
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
