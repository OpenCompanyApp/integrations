<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create a record by verification code.
 *
 * Maps to POST /api/verifications/verification-code in the official Logto OpenAPI source.
 */
class LogtoCreateVerificationByVerificationCode extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_verification_by_verification_code',
  'class' => 'LogtoCreateVerificationByVerificationCode',
  'method' => 'POST',
  'path' => '/api/verifications/verification-code',
  'operation_id' => 'CreateVerificationByVerificationCode',
  'summary' => 'Create a record by verification code',
  'description' => 'Create a verification record and send the code to the specified identifier. The code verification can be used to verify the given identifier.',
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
