<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Check if user has password.
 *
 * Maps to GET /api/users/{userId}/has-password in the official Logto OpenAPI source.
 */
class LogtoGetUserHasPassword extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_user_has_password',
  'class' => 'LogtoGetUserHasPassword',
  'method' => 'GET',
  'path' => '/api/users/{userId}/has-password',
  'operation_id' => 'GetUserHasPassword',
  'summary' => 'Check if user has password',
  'description' => 'Check if the user with the given ID has a password set.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
    ),
  ),
  'path_params' =>
  array (
    'userId' => 'user_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
