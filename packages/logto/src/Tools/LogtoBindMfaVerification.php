<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Bind MFA verification by verificationId.
 *
 * Maps to POST /api/experience/profile/mfa in the official Logto OpenAPI source.
 */
class LogtoBindMfaVerification extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_bind_mfa_verification',
  'class' => 'LogtoBindMfaVerification',
  'method' => 'POST',
  'path' => '/api/experience/profile/mfa',
  'operation_id' => 'BindMfaVerification',
  'summary' => 'Bind MFA verification by verificationId',
  'description' => 'Bind new MFA verification to the user profile using the verificationId.',
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
