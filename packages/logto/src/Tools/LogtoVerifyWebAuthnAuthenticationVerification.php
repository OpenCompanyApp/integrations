<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Verify WebAuthn authentication verification.
 *
 * Maps to POST /api/experience/verification/web-authn/authentication/verify in the official Logto OpenAPI source.
 */
class LogtoVerifyWebAuthnAuthenticationVerification extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_verify_web_authn_authentication_verification',
  'class' => 'LogtoVerifyWebAuthnAuthenticationVerification',
  'method' => 'POST',
  'path' => '/api/experience/verification/web-authn/authentication/verify',
  'operation_id' => 'VerifyWebAuthnAuthenticationVerification',
  'summary' => 'Verify WebAuthn authentication verification',
  'description' => 'Verifies the WebAuthn authentication response against the user\'s authentication challenge. Upon successful verification, the verification record will be marked as verified.',
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
