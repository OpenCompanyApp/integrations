<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Check if a password meets the password policy.
 *
 * Maps to POST /api/sign-in-exp/default/check-password in the official Logto OpenAPI source.
 */
class LogtoCheckPasswordWithDefaultSignInExperience extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_check_password_with_default_sign_in_experience',
  'class' => 'LogtoCheckPasswordWithDefaultSignInExperience',
  'method' => 'POST',
  'path' => '/api/sign-in-exp/default/check-password',
  'operation_id' => 'CheckPasswordWithDefaultSignInExperience',
  'summary' => 'Check if a password meets the password policy',
  'description' => 'Check if a password meets the password policy in the sign-in experience settings.',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
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
  'body_required' => true,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
