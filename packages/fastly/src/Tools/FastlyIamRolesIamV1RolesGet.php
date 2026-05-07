<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get IAM role by ID
 *
 * Maps to Fastly generated client operation IamRolesApi::iamV1RolesGet (GET /iam/v1/roles/{role_id}).
 */
class FastlyIamRolesIamV1RolesGet extends AbstractFastlyTool
{
    protected const NAME = 'fastly_iam_roles_iam_v1_roles_get';
    protected const DESCRIPTION = 'Get IAM role by ID

Official Fastly client operation: IamRolesApi::iamV1RolesGet
Endpoint: GET /iam/v1/roles/{role_id}

Get IAM role by ID';
    protected const PARAMETERS = array (
  'role_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `role_id`.',
  ),
  'include' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `include`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_iam_roles_iam_v1_roles_get',
  'class' => 'FastlyIamRolesIamV1RolesGet',
  'api_class' => 'IamRolesApi',
  'method_name' => 'iamV1RolesGet',
  'method' => 'GET',
  'path' => '/iam/v1/roles/{role_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get IAM role by ID',
  'description' => 'Get IAM role by ID',
  'type' => 'read',
  'parameters' =>
  array (
    'role_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `role_id`.',
    ),
    'include' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `include`.',
    ),
  ),
  'path_params' =>
  array (
    'role_id' => 'role_id',
  ),
  'query_params' =>
  array (
    'include' => 'include',
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
