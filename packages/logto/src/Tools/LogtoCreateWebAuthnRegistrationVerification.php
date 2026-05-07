<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create WebAuthn registration verification.
 *
 * Maps to POST /api/experience/verification/web-authn/registration in the official Logto OpenAPI source.
 */
class LogtoCreateWebAuthnRegistrationVerification extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_web_authn_registration_verification',
  'class' => 'LogtoCreateWebAuthnRegistrationVerification',
  'method' => 'POST',
  'path' => '/api/experience/verification/web-authn/registration',
  'operation_id' => 'CreateWebAuthnRegistrationVerification',
  'summary' => 'Create WebAuthn registration verification',
  'description' => 'Create a new WebAuthn registration verification record. The verification record can be used to bind a new WebAuthn credential to the user\'s profile.',
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
