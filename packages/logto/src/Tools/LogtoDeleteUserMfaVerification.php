<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Delete an MFA verification for a user.
 *
 * Maps to DELETE /api/users/{userId}/mfa-verifications/{verificationId} in the official Logto OpenAPI source.
 */
class LogtoDeleteUserMfaVerification extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_delete_user_mfa_verification',
  'class' => 'LogtoDeleteUserMfaVerification',
  'method' => 'DELETE',
  'path' => '/api/users/{userId}/mfa-verifications/{verificationId}',
  'operation_id' => 'DeleteUserMfaVerification',
  'summary' => 'Delete an MFA verification for a user',
  'description' => 'Delete an MFA verification for the user with the given verification ID. The verification ID must be associated with the given user ID.',
  'parameters' =>
  array (
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the user.',
    ),
    'verification_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The unique identifier of the verification.',
    ),
  ),
  'path_params' =>
  array (
    'userId' => 'user_id',
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
