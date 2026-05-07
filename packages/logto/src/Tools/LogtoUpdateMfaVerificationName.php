<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Update a MFA verification name.
 *
 * Maps to PATCH /api/my-account/mfa-verifications/{verificationId}/name in the official Logto OpenAPI source.
 */
class LogtoUpdateMfaVerificationName extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_update_mfa_verification_name',
  'class' => 'LogtoUpdateMfaVerificationName',
  'method' => 'PATCH',
  'path' => '/api/my-account/mfa-verifications/{verificationId}/name',
  'operation_id' => 'UpdateMfaVerificationName',
  'summary' => 'Update a MFA verification name',
  'description' => 'Update a MFA verification name, a logto-verification-id in header is required for checking sensitive permissions. Only WebAuthn is supported for now.',
  'parameters' =>
  array (
    'verification_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the verification.',
    ),
    'body' =>
    array (
      'type' => 'object',
      'required' => true,
      'description' => 'Request body matching the official Logto OpenAPI schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
    'verificationId' => 'verification_id',
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
