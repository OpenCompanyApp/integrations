<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Create a user
 *
 * Maps to Fastly generated client operation UserApi::createUser (POST /user).
 */
class FastlyUserCreateUser extends AbstractFastlyTool
{
    protected const NAME = 'fastly_user_create_user';
    protected const DESCRIPTION = 'Create a user

Official Fastly client operation: UserApi::createUser
Endpoint: POST /user

Create a user';
    protected const PARAMETERS = array (
  'login' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `login`.',
  ),
  'name' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `name`.',
  ),
  'limit_services' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `limit_services`.',
  ),
  'locked' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `locked`.',
  ),
  'require_new_password' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `require_new_password`.',
  ),
  'role' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `role`.',
  ),
  'roles' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `roles`.',
  ),
  'two_factor_auth_enabled' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `two_factor_auth_enabled`.',
  ),
  'two_factor_setup_required' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `two_factor_setup_required`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_user_create_user',
  'class' => 'FastlyUserCreateUser',
  'api_class' => 'UserApi',
  'method_name' => 'createUser',
  'method' => 'POST',
  'path' => '/user',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Create a user',
  'description' => 'Create a user',
  'type' => 'write',
  'parameters' =>
  array (
    'login' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `login`.',
    ),
    'name' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `name`.',
    ),
    'limit_services' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `limit_services`.',
    ),
    'locked' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `locked`.',
    ),
    'require_new_password' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `require_new_password`.',
    ),
    'role' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `role`.',
    ),
    'roles' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `roles`.',
    ),
    'two_factor_auth_enabled' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `two_factor_auth_enabled`.',
    ),
    'two_factor_setup_required' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `two_factor_setup_required`.',
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
    'login' => 'login',
    'name' => 'name',
    'limit_services' => 'limit_services',
    'locked' => 'locked',
    'require_new_password' => 'require_new_password',
    'role' => 'role',
    'roles' => 'roles',
    'two_factor_auth_enabled' => 'two_factor_auth_enabled',
    'two_factor_setup_required' => 'two_factor_setup_required',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
