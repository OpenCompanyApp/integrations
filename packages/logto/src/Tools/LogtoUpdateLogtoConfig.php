<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update logto config.
 *
 * Maps to PATCH /api/my-account/logto-configs in the official Logto OpenAPI source.
 */
class LogtoUpdateLogtoConfig extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_logto_config',
  'class' => 'LogtoUpdateLogtoConfig',
  'method' => 'PATCH',
  'path' => '/api/my-account/logto-configs',
  'operation_id' => 'UpdateLogtoConfig',
  'summary' => 'Update logto config',
  'description' => 'Update the exposed portion of the current user\'s logto config. Supports updating MFA states (enabled, skipped, skipMfaOnSignIn) and passkey sign-in binding states (skipped). Passkey is a WebAuthn MFA factor and shares the same account center field access control as MFA.',
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
