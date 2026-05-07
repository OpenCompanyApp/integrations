<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Verify verification code.
 *
 * Maps to POST /api/verifications/verification-code/verify in the official Logto OpenAPI source.
 */
class LogtoVerifyVerificationByVerificationCode extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_verify_verification_by_verification_code',
  'class' => 'LogtoVerifyVerificationByVerificationCode',
  'method' => 'POST',
  'path' => '/api/verifications/verification-code/verify',
  'operation_id' => 'VerifyVerificationByVerificationCode',
  'summary' => 'Verify verification code',
  'description' => 'Verify the provided verification code against the identifier. If successful, the verification record will be marked as verified.',
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
