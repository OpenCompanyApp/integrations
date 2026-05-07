<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Send an email-verification email to the user An email contains a link the user can click to verify their email address.
 *
 * Maps to PUT /admin/realms/{realm}/users/{user-id}/send-verify-email in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmUsersUserIdSendVerifyEmail extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_users_user_id_send_verify_email',
  'class' => 'KeycloakPutAdminRealmsRealmUsersUserIdSendVerifyEmail',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/users/{user-id}/send-verify-email',
  'summary' => 'Send an email-verification email to the user An email contains a link the user can click to verify their email address',
  'description' => 'The redirectUri, clientId and lifespan parameters are optional. The default for the redirect is the account client. The default for the lifespan is 12 hours',
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
      'description' => 'Client id',
    ),
    'lifespan' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Number of seconds after which the generated token expires',
    ),
    'redirect_uri' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Redirect uri',
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
    'lifespan' => 'lifespan',
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
