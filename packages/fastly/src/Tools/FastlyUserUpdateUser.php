<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update a user
 *
 * Maps to Fastly generated client operation UserApi::updateUser (PUT /user/{user_id}).
 */
class FastlyUserUpdateUser extends AbstractFastlyTool
{
    protected const NAME = 'fastly_user_update_user';
    protected const DESCRIPTION = 'Update a user

Official Fastly client operation: UserApi::updateUser
Endpoint: PUT /user/{user_id}

Update a user';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `user_id`.',
  ),
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
  'slug' => 'fastly_user_update_user',
  'class' => 'FastlyUserUpdateUser',
  'api_class' => 'UserApi',
  'method_name' => 'updateUser',
  'method' => 'PUT',
  'path' => '/user/{user_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update a user',
  'description' => 'Update a user',
  'type' => 'write',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `user_id`.',
    ),
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
    'user_id' => 'user_id',
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
