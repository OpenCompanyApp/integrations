<?php

namespace OpenCompany\Integrations\Fastly\Tools;

/**
 * Request a password reset
 *
 * Maps to Fastly generated client operation UserApi::requestPasswordReset (POST /user/{user_login}/password/request_reset).
 */
class FastlyUserRequestPasswordReset extends AbstractFastlyTool
{
    protected const NAME = 'fastly_user_request_password_reset';
    protected const DESCRIPTION = 'Request a password reset

Official Fastly client operation: UserApi::requestPasswordReset
Endpoint: POST /user/{user_login}/password/request_reset

Request a password reset';
    protected const PARAMETERS = array (
  'user_login' =>
  array (
    'type' => 'string',
    'required' => true,
    'description' => 'Fastly API parameter `user_login`.',
  ),
);
    protected const OPERATION = array (
  'slug' => 'fastly_user_request_password_reset',
  'class' => 'FastlyUserRequestPasswordReset',
  'api_class' => 'UserApi',
  'method_name' => 'requestPasswordReset',
  'method' => 'POST',
  'path' => '/user/{user_login}/password/request_reset',
  'hosts' =>
  array (
    0 => 'https://api.fastly.com',
  ),
  'operation_host' => 'https://api.fastly.com',
  'name' => 'Request a password reset',
  'description' => 'Request a password reset',
  'type' => 'write',
  'parameters' =>
  array (
    'user_login' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Fastly API parameter `user_login`.',
    ),
  ),
  'path_params' =>
  array (
    'user_login' => 'user_login',
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
