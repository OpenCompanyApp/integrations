<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Add a MFA verification.
 *
 * Maps to POST /api/my-account/mfa-verifications in the official Logto OpenAPI source.
 */
class LogtoAddMfaVerification extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_add_mfa_verification',
  'class' => 'LogtoAddMfaVerification',
  'method' => 'POST',
  'path' => '/api/my-account/mfa-verifications',
  'operation_id' => 'AddMfaVerification',
  'summary' => 'Add a MFA verification',
  'description' => 'Add a MFA verification to the user, a logto-verification-id in header is required for checking sensitive permissions.',
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
