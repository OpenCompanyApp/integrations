<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Verify a social verification record.
 *
 * Maps to POST /api/verifications/social/verify in the official Logto OpenAPI source.
 */
class LogtoVerifyVerificationBySocial extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_verify_verification_by_social',
  'class' => 'LogtoVerifyVerificationBySocial',
  'method' => 'POST',
  'path' => '/api/verifications/social/verify',
  'operation_id' => 'VerifyVerificationBySocial',
  'summary' => 'Verify a social verification record',
  'description' => 'Verify a social verification record by callback connector data, and save the user information to the record.',
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
