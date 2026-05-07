<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update MFA settings.
 *
 * Maps to PATCH /api/my-account/mfa-settings in the official Logto OpenAPI source.
 */
class LogtoUpdateMfaSettings extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_mfa_settings',
  'class' => 'LogtoUpdateMfaSettings',
  'method' => 'PATCH',
  'path' => '/api/my-account/mfa-settings',
  'operation_id' => 'UpdateMfaSettings',
  'summary' => 'Update MFA settings',
  'description' => 'Update MFA settings for the user. This endpoint requires identity verification and the Identities scope. Controls whether MFA verification is required during sign-in when the user has MFA configured.',
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
