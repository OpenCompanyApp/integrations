<?php

namespace OpenCompany\Integrations\Logto\Tools;

/**
 * Create new password identity verification.
 *
 * Maps to POST /api/experience/verification/new-password-identity in the official Logto OpenAPI source.
 */
class LogtoCreateNewPasswordIdentityVerification extends AbstractLogtoTool
{
    protected const OPERATION = array (
  'slug' => 'logto_create_new_password_identity_verification',
  'class' => 'LogtoCreateNewPasswordIdentityVerification',
  'method' => 'POST',
  'path' => '/api/experience/verification/new-password-identity',
  'operation_id' => 'CreateNewPasswordIdentityVerification',
  'summary' => 'Create new password identity verification',
  'description' => 'Create a NewPasswordIdentity verification record for the new user registration use. The verification record includes a unique user identifier and a password that can be used to create a new user account.',
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
