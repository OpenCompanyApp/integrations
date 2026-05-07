<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Delete a user
 *
 * Maps to Fastly generated client operation UserApi::deleteUser (DELETE /user/{user_id}).
 */
class FastlyUserDeleteUser extends AbstractFastlyTool
{
    protected const NAME = 'fastly_user_delete_user';
    protected const DESCRIPTION = 'Delete a user

Official Fastly client operation: UserApi::deleteUser
Endpoint: DELETE /user/{user_id}

Delete a user';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `user_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_user_delete_user',
  'class' => 'FastlyUserDeleteUser',
  'api_class' => 'UserApi',
  'method_name' => 'deleteUser',
  'method' => 'DELETE',
  'path' => '/user/{user_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Delete a user',
  'description' => 'Delete a user',
  'type' => 'write',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `user_id`.',
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
  ),
  'body_param' => NULL,
  'body_required' => false,
);
}
