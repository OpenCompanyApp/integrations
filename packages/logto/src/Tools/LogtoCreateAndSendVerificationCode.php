<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create and send verification code.
 *
 * Maps to POST /api/experience/verification/verification-code in the official Logto OpenAPI source.
 */
class LogtoCreateAndSendVerificationCode extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_and_send_verification_code',
  'class' => 'LogtoCreateAndSendVerificationCode',
  'method' => 'POST',
  'path' => '/api/experience/verification/verification-code',
  'operation_id' => 'CreateAndSendVerificationCode',
  'summary' => 'Create and send verification code',
  'description' => 'Create a new `CodeVerification` record and sends the code to the specified identifier. The code verification can be used to verify the given identifier.',
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
