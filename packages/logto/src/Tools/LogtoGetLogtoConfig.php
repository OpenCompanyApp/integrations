<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get logto config.
 *
 * Maps to GET /api/my-account/logto-configs in the official Logto OpenAPI source.
 */
class LogtoGetLogtoConfig extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_logto_config',
  'class' => 'LogtoGetLogtoConfig',
  'method' => 'GET',
  'path' => '/api/my-account/logto-configs',
  'operation_id' => 'GetLogtoConfig',
  'summary' => 'Get logto config',
  'description' => 'Retrieve the exposed portion of the current user\'s logto config. This includes MFA states (enabled, skipped, skipMfaOnSignIn) and passkey sign-in binding states (skipped). Passkey is a WebAuthn MFA factor and shares the same account center field access control as MFA.',
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
  'type' => 'read',
);
}
