<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Get the current user
 *
 * Maps to Fastly generated client operation UserApi::getCurrentUser (GET /current_user).
 */
class FastlyUserGetCurrentUser extends AbstractFastlyTool
{
    protected const NAME = 'fastly_user_get_current_user';
    protected const DESCRIPTION = 'Get the current user

Official Fastly client operation: UserApi::getCurrentUser
Endpoint: GET /current_user

Get the current user';
    protected const PARAMETERS = array (
);
    protected const OPERATION = array (
  'slug' => 'fastly_user_get_current_user',
  'class' => 'FastlyUserGetCurrentUser',
  'api_class' => 'UserApi',
  'method_name' => 'getCurrentUser',
  'method' => 'GET',
  'path' => '/current_user',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Get the current user',
  'description' => 'Get the current user',
  'type' => 'read',
  'parameters' =>
  array (
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
  'body_param' => NULL,
  'body_required' => false,
);
}
