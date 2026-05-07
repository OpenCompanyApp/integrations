<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get a user
 *
 * Maps to Fastly generated client operation UserApi::getUser (GET /user/{user_id}).
 */
class FastlyUserGetUser extends AbstractFastlyTool
{
    protected const NAME = 'fastly_user_get_user';
    protected const DESCRIPTION = 'Get a user

Official Fastly client operation: UserApi::getUser
Endpoint: GET /user/{user_id}

Get a user';
    protected const PARAMETERS = array (
  'user_id' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `user_id`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_user_get_user',
  'class' => 'FastlyUserGetUser',
  'api_class' => 'UserApi',
  'method_name' => 'getUser',
  'method' => 'GET',
  'path' => '/user/{user_id}',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get a user',
  'description' => 'Get a user',
  'type' => 'read',
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
