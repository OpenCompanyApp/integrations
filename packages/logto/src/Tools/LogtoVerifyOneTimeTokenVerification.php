<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Verify one-time token.
 *
 * Maps to POST /api/experience/verification/one-time-token/verify in the official Logto OpenAPI source.
 */
class LogtoVerifyOneTimeTokenVerification extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_verify_one_time_token_verification',
  'class' => 'LogtoVerifyOneTimeTokenVerification',
  'method' => 'POST',
  'path' => '/api/experience/verification/one-time-token/verify',
  'operation_id' => 'VerifyOneTimeTokenVerification',
  'summary' => 'Verify one-time token',
  'description' => 'Verify the provided one-time token against the user\'s email. If successful, the verification record will be marked as verified.',
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
