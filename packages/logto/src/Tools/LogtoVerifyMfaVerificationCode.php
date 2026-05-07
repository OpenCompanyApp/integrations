<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Verify MFA verification code.
 *
 * Maps to POST /api/experience/verification/mfa-verification-code/verify in the official Logto OpenAPI source.
 */
class LogtoVerifyMfaVerificationCode extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_verify_mfa_verification_code',
  'class' => 'LogtoVerifyMfaVerificationCode',
  'method' => 'POST',
  'path' => '/api/experience/verification/mfa-verification-code/verify',
  'operation_id' => 'VerifyMfaVerificationCode',
  'summary' => 'Verify MFA verification code',
  'description' => 'Verify the provided MFA verification code. The verification code must have been sent using the MFA verification code endpoint. This endpoint verifies the code against the user\'s bound identifier and marks the verification as complete if successful.',
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
