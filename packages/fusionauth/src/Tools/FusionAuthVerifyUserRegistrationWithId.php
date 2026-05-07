<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * verify User Registration With Id.
 *
 * Maps to POST /api/user/verify-registration in the official FusionAuth OpenAPI document.
 */
class FusionAuthVerifyUserRegistrationWithId extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_verify_user_registration_with_id',
  'class' => 'FusionAuthVerifyUserRegistrationWithId',
  'method' => 'POST',
  'path' => '/api/user/verify-registration',
  'operation_id' => 'verifyUserRegistrationWithId',
  'summary' => 'verify User Registration With Id',
  'description' => 'Confirms a user\'s registration. The request body will contain the verificationId. You may also be required to send a one-time use code based upon your configuration. When the application is configured to gate a user until their registration is verified, this procedures requires two values instead of one. The verificationId is a high entropy value and the one-time use code is a low entropy value that is easily entered in a user interactive form. The two values together are able to confirm a user\'',
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
