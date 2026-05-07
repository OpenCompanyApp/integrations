<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * create User Change Password.
 *
 * Maps to POST /api/user/change-password in the official FusionAuth OpenAPI document.
 */
class FusionAuthCreateUserChangePassword extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_create_user_change_password',
  'class' => 'FusionAuthCreateUserChangePassword',
  'method' => 'POST',
  'path' => '/api/user/change-password',
  'operation_id' => 'createUserChangePassword',
  'summary' => 'create User Change Password',
  'description' => 'Changes a user\'s password using their access token (JWT) instead of the changePasswordId A common use case for this method will be if you want to allow the user to change their own password. Remember to send refreshToken in the request body if you want to get a new refresh token when login using the returned oneTimePassword. OR Changes a user\'s password using their identity (loginId and password). Using a loginId instead of the changePasswordId bypasses the email verification and allows a passwo',
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
