<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve User Change Password.
 *
 * Maps to GET /api/user/change-password in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveUserChangePassword extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_user_change_password',
  'class' => 'FusionAuthRetrieveUserChangePassword',
  'method' => 'GET',
  'path' => '/api/user/change-password',
  'operation_id' => 'retrieveUserChangePassword',
  'summary' => 'retrieve User Change Password',
  'description' => 'Check to see if the user must obtain a Trust Request Id in order to complete a change password request. When a user has enabled Two-Factor authentication, before you are allowed to use the Change Password API to change your password, you must obtain a Trust Request Id by completing a Two-Factor Step-Up authentication. An HTTP status code of 400 with a general error code of [TrustTokenRequired] indicates that a Trust Token is required to make a POST request to this API. OR Check to see if the use',
  'parameters' =>
  array (
    'login_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The loginId of the User that you intend to change the password for.',
    ),
    'login_id_types' =>
    array (
      'type' => 'array',
      'required' => false,
      'description' => 'The identity types that FusionAuth will compare the loginId to.',
    ),
    'ip_address' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'IP address of the user changing their password. This is used for MFA risk assessment.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'loginId' => 'login_id',
    'loginIdTypes' => 'login_id_types',
    'ipAddress' => 'ip_address',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
