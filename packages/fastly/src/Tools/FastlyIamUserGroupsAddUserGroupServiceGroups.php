<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Add service groups to a user group
 *
 * Maps to Fastly generated client operation IamUserGroupsApi::addUserGroupServiceGroups (POST /user-groups/{user_group_id}/service-groups).
 */
class FastlyIamUserGroupsAddUserGroupServiceGroups extends AbstractFastlyTool
{
    protected const NAME = 'fastly_iam_user_groups_add_user_group_service_groups';
    protected const DESCRIPTION = 'Add service groups to a user group

Official Fastly client operation: IamUserGroupsApi::addUserGroupServiceGroups
Endpoint: POST /user-groups/{user_group_id}/service-groups

Add service groups to a user group';
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
  'slug' => 'fastly_iam_user_groups_add_user_group_service_groups',
  'class' => 'FastlyIamUserGroupsAddUserGroupServiceGroups',
  'api_class' => 'IamUserGroupsApi',
  'method_name' => 'addUserGroupServiceGroups',
  'method' => 'POST',
  'path' => '/user-groups/{user_group_id}/service-groups',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Add service groups to a user group',
  'description' => 'Add service groups to a user group',
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
