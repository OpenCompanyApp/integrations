<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete an MFA verification.
 *
 * Maps to DELETE /api/my-account/mfa-verifications/{verificationId} in the official Logto OpenAPI source.
 */
class LogtoDeleteMfaVerification extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_mfa_verification',
  'class' => 'LogtoDeleteMfaVerification',
  'method' => 'DELETE',
  'path' => '/api/my-account/mfa-verifications/{verificationId}',
  'operation_id' => 'DeleteMfaVerification',
  'summary' => 'Delete an MFA verification',
  'description' => 'Delete an MFA verification, a logto-verification-id in header is required for checking sensitive permissions.',
  'parameters' =>
  array (
    'verification_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the verification.',
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
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
