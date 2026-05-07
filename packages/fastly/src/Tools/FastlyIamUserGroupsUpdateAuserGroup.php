<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a user group
 *
 * Maps to Fastly generated client operation IamUserGroupsApi::updateAUserGroup (PATCH /user-groups/{user_group_id}).
 */
class FastlyIamUserGroupsUpdateAuserGroup extends AbstractFastlyTool
{
    protected const NAME = 'fastly_iam_user_groups_update_auser_group';
    protected const DESCRIPTION = 'Update a user group

Official Fastly client operation: IamUserGroupsApi::updateAUserGroup
Endpoint: PATCH /user-groups/{user_group_id}

Update a user group';
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
  'slug' => 'fastly_iam_user_groups_update_auser_group',
  'class' => 'FastlyIamUserGroupsUpdateAuserGroup',
  'api_class' => 'IamUserGroupsApi',
  'method_name' => 'updateAUserGroup',
  'method' => 'PATCH',
  'path' => '/user-groups/{user_group_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a user group',
  'description' => 'Update a user group',
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
