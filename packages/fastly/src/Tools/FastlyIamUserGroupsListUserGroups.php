<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List user groups
 *
 * Maps to Fastly generated client operation IamUserGroupsApi::listUserGroups (GET /user-groups).
 */
class FastlyIamUserGroupsListUserGroups extends AbstractFastlyTool
{
    protected const NAME = 'fastly_iam_user_groups_list_user_groups';
    protected const DESCRIPTION = 'List user groups

Official Fastly client operation: IamUserGroupsApi::listUserGroups
Endpoint: GET /user-groups

List user groups';
    protected const PARAMETERS = array (
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
  'slug' => 'fastly_iam_user_groups_list_user_groups',
  'class' => 'FastlyIamUserGroupsListUserGroups',
  'api_class' => 'IamUserGroupsApi',
  'method_name' => 'listUserGroups',
  'method' => 'GET',
  'path' => '/user-groups',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List user groups',
  'description' => 'List user groups',
  'type' => 'read',
  'parameters' =>
  array (
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
