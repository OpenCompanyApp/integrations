<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a user group
 *
 * Maps to Fastly generated client operation IamUserGroupsApi::createAUserGroup (POST /user-groups).
 */
class FastlyIamUserGroupsCreateAuserGroup extends AbstractFastlyTool
{
    protected const NAME = 'fastly_iam_user_groups_create_auser_group';
    protected const DESCRIPTION = 'Create a user group

Official Fastly client operation: IamUserGroupsApi::createAUserGroup
Endpoint: POST /user-groups

Create a user group';
    protected const PARAMETERS = array (
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
  'slug' => 'fastly_iam_user_groups_create_auser_group',
  'class' => 'FastlyIamUserGroupsCreateAuserGroup',
  'api_class' => 'IamUserGroupsApi',
  'method_name' => 'createAUserGroup',
  'method' => 'POST',
  'path' => '/user-groups',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a user group',
  'description' => 'Create a user group',
  'type' => 'write',
  'parameters' =>
  array (
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
