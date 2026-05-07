<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a user group
 *
 * Maps to Fastly generated client operation IamUserGroupsApi::getAUserGroup (GET /user-groups/{user_group_id}).
 */
class FastlyIamUserGroupsGetAuserGroup extends AbstractFastlyTool
{
    protected const NAME = 'fastly_iam_user_groups_get_auser_group';
    protected const DESCRIPTION = 'Get a user group

Official Fastly client operation: IamUserGroupsApi::getAUserGroup
Endpoint: GET /user-groups/{user_group_id}

Get a user group';
    protected const PARAMETERS = array (
  'user_group_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `user_group_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_iam_user_groups_get_auser_group',
  'class' => 'FastlyIamUserGroupsGetAuserGroup',
  'api_class' => 'IamUserGroupsApi',
  'method_name' => 'getAUserGroup',
  'method' => 'GET',
  'path' => '/user-groups/{user_group_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a user group',
  'description' => 'Get a user group',
  'type' => 'read',
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
