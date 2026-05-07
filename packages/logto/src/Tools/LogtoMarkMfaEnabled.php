<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Mark MFA as enabled.
 *
 * Maps to POST /api/experience/profile/mfa/mfa-enabled in the official Logto OpenAPI source.
 */
class LogtoMarkMfaEnabled extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_mark_mfa_enabled',
  'class' => 'LogtoMarkMfaEnabled',
  'method' => 'POST',
  'path' => '/api/experience/profile/mfa/mfa-enabled',
  'operation_id' => 'MarkMfaEnabled',
  'summary' => 'Mark MFA as enabled',
  'description' => 'Mark the user\'s MFA as enabled for the current interaction and persist in DB user configs upon successful submission.',
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
