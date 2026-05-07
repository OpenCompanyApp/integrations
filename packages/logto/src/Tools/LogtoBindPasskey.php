<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Bind passkey for sign-in.
 *
 * Maps to POST /api/experience/profile/mfa/passkey in the official Logto OpenAPI source.
 */
class LogtoBindPasskey extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_bind_passkey',
  'class' => 'LogtoBindPasskey',
  'method' => 'POST',
  'path' => '/api/experience/profile/mfa/passkey',
  'operation_id' => 'BindPasskey',
  'summary' => 'Bind passkey for sign-in',
  'description' => 'Bind a WebAuthn credential as a passkey for sign-in purposes. Unlike `POST /api/experience/profile/mfa` with `type: WebAuthn`, this endpoint is exclusively for adding a passkey as a sign-in method and does NOT mark the user\'s optional MFA as enabled.',
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
