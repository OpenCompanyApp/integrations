<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Send an email to the user with a link they can click to reset their password.
 *
 * Maps to PUT /admin/realms/{realm}/users/{user-id}/reset-password-email in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmUsersUserIdResetPasswordEmail extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_users_user_id_reset_password_email',
  'class' => 'KeycloakPutAdminRealmsRealmUsersUserIdResetPasswordEmail',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/users/{user-id}/reset-password-email',
  'summary' => 'Send an email to the user with a link they can click to reset their password',
  'description' => 'The redirectUri and clientId parameters are optional. The default for the redirect is the account client. This endpoint has been deprecated. Please use the execute-actions-email passing a list with UPDATE_PASSWORD within it.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'user_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `user-id`.',
    ),
    'client_id' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'client id',
    ),
    'redirect_uri' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'redirect uri',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'user-id' => 'user_id',
  ),
  'query_params' =>
  array (
    'client_id' => 'client_id',
    'redirect_uri' => 'redirect_uri',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
