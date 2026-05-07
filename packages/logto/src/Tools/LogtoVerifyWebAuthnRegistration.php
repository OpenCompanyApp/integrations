<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Verify WebAuthn registration.
 *
 * Maps to POST /api/verifications/web-authn/registration/verify in the official Logto OpenAPI source.
 */
class LogtoVerifyWebAuthnRegistration extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_verify_web_authn_registration',
  'class' => 'LogtoVerifyWebAuthnRegistration',
  'method' => 'POST',
  'path' => '/api/verifications/web-authn/registration/verify',
  'operation_id' => 'VerifyWebAuthnRegistration',
  'summary' => 'Verify WebAuthn registration',
  'description' => 'Verify the WebAuthn registration by the user\'s response.',
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
