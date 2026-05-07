<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create User Verify Email.
 *
 * Maps to POST /api/user/verify-email in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateUserVerifyEmail extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_user_verify_email',
  'class' => 'FusionAuthCreateUserVerifyEmail',
  'method' => 'POST',
  'path' => '/api/user/verify-email',
  'operation_id' => 'createUserVerifyEmail',
  'summary' => 'create User Verify Email',
  'description' => 'Administratively verify a user\'s email address. Use this method to bypass email verification for the user. The request body will contain the userId to be verified. An API key is required when sending the userId in the request body. OR Confirms a user\'s email address. The request body will contain the verificationId. You may also be required to send a one-time use code based upon your configuration. When the tenant is configured to gate a user until their email address is verified, this procedure',
  'parameters' =>
  array (
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official FusionAuth OpenAPI schema for this endpoint.',
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
  'body_required' => false,
  'content_type' => 'application/json',
  'type' => 'write',
);
}
