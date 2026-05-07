<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Skip MFA binding flow.
 *
 * Maps to POST /api/experience/profile/mfa/mfa-skipped in the official Logto OpenAPI source.
 */
class LogtoSkipMfaBindingFlow extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_skip_mfa_binding_flow',
  'class' => 'LogtoSkipMfaBindingFlow',
  'method' => 'POST',
  'path' => '/api/experience/profile/mfa/mfa-skipped',
  'operation_id' => 'SkipMfaBindingFlow',
  'summary' => 'Skip MFA binding flow',
  'description' => 'Skip MFA verification binding flow. If the MFA is enabled in the sign-in experience settings and marked as `UserControlled`, the user can skip the MFA verification binding flow by calling this API.',
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
