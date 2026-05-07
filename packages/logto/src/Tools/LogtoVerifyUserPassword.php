<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Verify user password.
 *
 * Maps to POST /api/users/{userId}/password/verify in the official Logto OpenAPI source.
 */
class LogtoVerifyUserPassword extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_verify_user_password',
  'class' => 'LogtoVerifyUserPassword',
  'method' => 'POST',
  'path' => '/api/users/{userId}/password/verify',
  'operation_id' => 'VerifyUserPassword',
  'summary' => 'Verify user password',
  'description' => 'Test if the given password matches the user\'s password.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
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
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
