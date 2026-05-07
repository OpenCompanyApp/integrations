<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Request and send a verification code.
 *
 * Maps to POST /api/verification-codes in the official Logto OpenAPI source.
 */
class LogtoCreateVerificationCode extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_verification_code',
  'class' => 'LogtoCreateVerificationCode',
  'method' => 'POST',
  'path' => '/api/verification-codes',
  'operation_id' => 'CreateVerificationCode',
  'summary' => 'Request and send a verification code',
  'description' => 'Request a verification code for the provided identifier (email/phone). if you\'re using email as the identifier, you need to setup your email connector first. if you\'re using phone as the identifier, you need to setup your SMS connector first.',
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
