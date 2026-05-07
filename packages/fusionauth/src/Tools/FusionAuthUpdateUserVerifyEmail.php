<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * update User Verify Email.
 *
 * Maps to PUT /api/user/verify-email in the official FusionAuth OpenAPI document.
 */
class FusionAuthUpdateUserVerifyEmail extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_update_user_verify_email',
  'class' => 'FusionAuthUpdateUserVerifyEmail',
  'method' => 'PUT',
  'path' => '/api/user/verify-email',
  'operation_id' => 'updateUserVerifyEmail',
  'summary' => 'update User Verify Email',
  'description' => 'Re-sends the verification email to the user. If the Application has configured a specific email template this will be used instead of the tenant configuration. OR Re-sends the verification email to the user. OR Generate a new Email Verification Id to be used with the Verify Email API. This API will not attempt to send an email to the User. This API may be used to collect the verificationId for use with a third party system.',
  'parameters' =>
  array (
    'application_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Application Id to used to resolve an application specific email template.',
    ),
    'email' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The email address of the user that needs a new verification email.',
    ),
    'send_verify_email' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Official FusionAuth query parameter `sendVerifyEmail`.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'applicationId' => 'application_id',
    'email' => 'email',
    'sendVerifyEmail' => 'send_verify_email',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
