<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Update the user's password
 *
 * Maps to Fastly generated client operation UserApi::updateUserPassword (POST /current_user/password).
 */
class FastlyUserUpdateUserPassword extends AbstractFastlyTool
{
    protected const NAME = 'fastly_user_update_user_password';
    protected const DESCRIPTION = 'Update the user\'s password

Official Fastly client operation: UserApi::updateUserPassword
Endpoint: POST /current_user/password

Update the user\'s password';
    protected const PARAMETERS = array (
  'old_password' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `old_password`.',
  ),
  'new_password' =>
  array (
    'type' => 'string',
    'required' => false,
    'description' => 'Fastly API parameter `new_password`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_user_update_user_password',
  'class' => 'FastlyUserUpdateUserPassword',
  'api_class' => 'UserApi',
  'method_name' => 'updateUserPassword',
  'method' => 'POST',
  'path' => '/current_user/password',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Update the user\'s password',
  'description' => 'Update the user\'s password',
  'type' => 'write',
  'parameters' =>
  array (
    'old_password' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `old_password`.',
    ),
    'new_password' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Fastly API parameter `new_password`.',
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
    'old_password' => 'old_password',
    'new_password' => 'new_password',
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
