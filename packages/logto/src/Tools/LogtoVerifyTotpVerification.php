<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Verify TOTP verification.
 *
 * Maps to POST /api/experience/verification/totp/verify in the official Logto OpenAPI source.
 */
class LogtoVerifyTotpVerification extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_verify_totp_verification',
  'class' => 'LogtoVerifyTotpVerification',
  'method' => 'POST',
  'path' => '/api/experience/verification/totp/verify',
  'operation_id' => 'VerifyTotpVerification',
  'summary' => 'Verify TOTP verification',
  'description' => 'Verifies the provided TOTP code against the new created TOTP secret or the existing TOTP secret. If a verificationId is provided, this API will verify the code against the TOTP secret that is associated with the verification record. Otherwise, a new TOTP verification record will be created and verified against the user\'s existing TOTP secret.',
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
