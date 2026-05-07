<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Verify WebAuthn registration verification.
 *
 * Maps to POST /api/experience/verification/web-authn/registration/verify in the official Logto OpenAPI source.
 */
class LogtoVerifyWebAuthnRegistrationVerification extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_verify_web_authn_registration_verification',
  'class' => 'LogtoVerifyWebAuthnRegistrationVerification',
  'method' => 'POST',
  'path' => '/api/experience/verification/web-authn/registration/verify',
  'operation_id' => 'VerifyWebAuthnRegistrationVerification',
  'summary' => 'Verify WebAuthn registration verification',
  'description' => 'Verify the WebAuthn registration response against the user\'s WebAuthn registration challenge. If the response is valid, the WebAuthn registration record will be marked as verified.',
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
