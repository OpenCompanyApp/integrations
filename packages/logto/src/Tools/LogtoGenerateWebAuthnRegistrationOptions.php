<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Generate WebAuthn registration options.
 *
 * Maps to POST /api/verifications/web-authn/registration in the official Logto OpenAPI source.
 */
class LogtoGenerateWebAuthnRegistrationOptions extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_generate_web_authn_registration_options',
  'class' => 'LogtoGenerateWebAuthnRegistrationOptions',
  'method' => 'POST',
  'path' => '/api/verifications/web-authn/registration',
  'operation_id' => 'GenerateWebAuthnRegistrationOptions',
  'summary' => 'Generate WebAuthn registration options',
  'description' => 'Generate WebAuthn registration options for the user to register a new WebAuthn device.',
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
