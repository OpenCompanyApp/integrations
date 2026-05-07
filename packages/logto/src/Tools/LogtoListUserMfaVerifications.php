<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get user's MFA verifications.
 *
 * Maps to GET /api/users/{userId}/mfa-verifications in the official Logto OpenAPI source.
 */
class LogtoListUserMfaVerifications extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_list_user_mfa_verifications',
  'class' => 'LogtoListUserMfaVerifications',
  'method' => 'GET',
  'path' => '/api/users/{userId}/mfa-verifications',
  'operation_id' => 'ListUserMfaVerifications',
  'summary' => 'Get user\'s MFA verifications',
  'description' => 'Get a user\'s existing MFA verifications for a given user ID.',
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
