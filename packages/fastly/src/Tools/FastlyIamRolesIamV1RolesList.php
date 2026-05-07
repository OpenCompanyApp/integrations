<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * List IAM roles
 *
 * Maps to Fastly generated client operation IamRolesApi::iamV1RolesList (GET /iam/v1/roles).
 */
class FastlyIamRolesIamV1RolesList extends AbstractFastlyTool
{
    protected const NAME = 'fastly_iam_roles_iam_v1_roles_list';
    protected const DESCRIPTION = 'List IAM roles

Official Fastly client operation: IamRolesApi::iamV1RolesList
Endpoint: GET /iam/v1/roles

List IAM roles';
    protected const PARAMETERS = array (
  'limit' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `limit`.',
  ),
  'cursor' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `cursor`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_iam_roles_iam_v1_roles_list',
  'class' => 'FastlyIamRolesIamV1RolesList',
  'api_class' => 'IamRolesApi',
  'method_name' => 'iamV1RolesList',
  'method' => 'GET',
  'path' => '/iam/v1/roles',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'List IAM roles',
  'description' => 'List IAM roles',
  'type' => 'read',
  'parameters' =>
  array (
    'limit' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `limit`.',
    ),
    'cursor' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `cursor`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'limit' => 'limit',
    'cursor' => 'cursor',
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
