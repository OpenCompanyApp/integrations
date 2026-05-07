<?php

namespace OpenCompany\Integrations\FusionAuth\Tools;

/**
 * retrieve User.
 *
 * Maps to GET /api/user in the official FusionAuth OpenAPI document.
 */
class FusionAuthRetrieveUser extends AbstractFusionAuthTool
{
    protected const OPERATION = array (
  'slug' => 'fusionauth_retrieve_user',
  'class' => 'FusionAuthRetrieveUser',
  'method' => 'GET',
  'path' => '/api/user',
  'operation_id' => 'retrieveUser',
  'summary' => 'retrieve User',
  'description' => 'Retrieves the user by a verificationId. The intended use of this API is to retrieve a user after the forgot password workflow has been initiated and you may not know the user\'s email or username. OR Retrieves the user for the given username. OR Retrieves the user for the loginId, using specific loginIdTypes. OR Retrieves the user for the loginId. The loginId can be either the username or the email. OR Retrieves the user for the given email. OR Retrieves the user by a change password Id. The inte',
  'parameters' =>
  array (
    'verification_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique verification Id that has been set on the user object.',
    ),
    'tenant_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique Id of the tenant used to scope this API request. Only required when there is more than one tenant and the API key is not tenant-scoped.',
    ),
    'username' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The username of the user.',
    ),
    'login_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The email or username of the user.',
    ),
    'login_id_types' =>
    array (
      'type' => 'array',
      'required' => false,
      'description' => 'The identity types that FusionAuth will compare the loginId to.',
    ),
    'email' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The email of the user.',
    ),
    'change_password_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'The unique change password Id that was sent via email or returned by the Forgot Password API.',
    ),
  ),
  'path_params' =>
  array (
  ),
  'query_params' =>
  array (
    'verificationId' => 'verification_id',
    'username' => 'username',
    'loginId' => 'login_id',
    'loginIdTypes' => 'login_id_types',
    'email' => 'email',
    'changePasswordId' => 'change_password_id',
  ),
  'header_params' =>
  array (
    'X-FusionAuth-TenantId' => 'tenant_id',
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
