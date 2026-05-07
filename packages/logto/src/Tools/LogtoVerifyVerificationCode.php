<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Verify a verification code.
 *
 * Maps to POST /api/verification-codes/verify in the official Logto OpenAPI source.
 */
class LogtoVerifyVerificationCode extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_verify_verification_code',
  'class' => 'LogtoVerifyVerificationCode',
  'method' => 'POST',
  'path' => '/api/verification-codes/verify',
  'operation_id' => 'VerifyVerificationCode',
  'summary' => 'Verify a verification code',
  'description' => 'Verify a verification code for a specified identifier. if you\'re using email as the identifier, you need to setup your email connector first. if you\'re using phone as the identifier, you need to setup your SMS connector first.',
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
