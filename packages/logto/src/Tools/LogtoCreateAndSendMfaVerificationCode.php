<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create and send MFA verification code.
 *
 * Maps to POST /api/experience/verification/mfa-verification-code in the official Logto OpenAPI source.
 */
class LogtoCreateAndSendMfaVerificationCode extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_and_send_mfa_verification_code',
  'class' => 'LogtoCreateAndSendMfaVerificationCode',
  'method' => 'POST',
  'path' => '/api/experience/verification/mfa-verification-code',
  'operation_id' => 'CreateAndSendMfaVerificationCode',
  'summary' => 'Create and send MFA verification code',
  'description' => 'Create a new MFA verification code and send it to the user\'s bound identifier (email or phone). This endpoint automatically uses the user\'s bound email address or phone number from their profile for MFA verification. The user must be identified before calling this endpoint.',
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
