<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create WebAuthn authentication verification.
 *
 * Maps to POST /api/experience/verification/web-authn/authentication in the official Logto OpenAPI source.
 */
class LogtoCreateWebAuthnAuthenticationVerification extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_web_authn_authentication_verification',
  'class' => 'LogtoCreateWebAuthnAuthenticationVerification',
  'method' => 'POST',
  'path' => '/api/experience/verification/web-authn/authentication',
  'operation_id' => 'CreateWebAuthnAuthenticationVerification',
  'summary' => 'Create WebAuthn authentication verification',
  'description' => 'Create a new WebAuthn authentication verification record based on the user\'s existing WebAuthn credential. This verification record can be used to verify the user\'s WebAuthn credential.',
  'parameters' =>
  array (
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
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
