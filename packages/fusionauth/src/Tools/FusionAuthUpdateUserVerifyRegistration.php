<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update User Verify Registration.
 *
 * Maps to PUT /api/user/verify-registration in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateUserVerifyRegistration extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_user_verify_registration',
  'class' => 'FusionAuthUpdateUserVerifyRegistration',
  'method' => 'PUT',
  'path' => '/api/user/verify-registration',
  'operation_id' => 'updateUserVerifyRegistration',
  'summary' => 'update User Verify Registration',
  'description' => 'Re-sends the application registration verification email to the user. OR Generate a new Application Registration Verification Id to be used with the Verify Registration API. This API will not attempt to send an email to the User. This API may be used to collect the verificationId for use with a third party system.',
  'parameters' =>
  array (
    'email' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The email address of the user that needs a new verification email.',
    ),
    'application_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The Id of the application to be verified.',
    ),
    'send_verify_password_email' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official FusionAuth query parameter `sendVerifyPasswordEmail`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'email' => 'email',
    'applicationId' => 'application_id',
    'sendVerifyPasswordEmail' => 'send_verify_password_email',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
