<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Skip passkey binding.
 *
 * Maps to POST /api/experience/profile/mfa/passkey-skipped in the official Logto OpenAPI source.
 */
class LogtoSkipPasskeyBinding extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_skip_passkey_binding',
  'class' => 'LogtoSkipPasskeyBinding',
  'method' => 'POST',
  'path' => '/api/experience/profile/mfa/passkey-skipped',
  'operation_id' => 'SkipPasskeyBinding',
  'summary' => 'Skip passkey binding',
  'description' => 'Skip passkey binding flow. The users can temporarily skip the passkey binding flow by calling this API during sign-up. On sign-in, the skip flag will be persisted to user config.',
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
