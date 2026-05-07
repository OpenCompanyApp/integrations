<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Get MFA settings.
 *
 * Maps to GET /api/my-account/mfa-settings in the official Logto OpenAPI source.
 */
class LogtoGetMfaSettings extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_get_mfa_settings',
  'class' => 'LogtoGetMfaSettings',
  'method' => 'GET',
  'path' => '/api/my-account/mfa-settings',
  'operation_id' => 'GetMfaSettings',
  'summary' => 'Get MFA settings',
  'description' => 'Get MFA settings for the user. This endpoint requires the Identities scope. Returns current MFA configuration preferences.',
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
