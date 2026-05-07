<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create an MFA verification for a user.
 *
 * Maps to POST /api/users/{userId}/mfa-verifications in the official Logto OpenAPI source.
 */
class LogtoCreateUserMfaVerification extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_user_mfa_verification',
  'class' => 'LogtoCreateUserMfaVerification',
  'method' => 'POST',
  'path' => '/api/users/{userId}/mfa-verifications',
  'operation_id' => 'CreateUserMfaVerification',
  'summary' => 'Create an MFA verification for a user',
  'description' => 'Create a new MFA verification for a given user ID.',
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
