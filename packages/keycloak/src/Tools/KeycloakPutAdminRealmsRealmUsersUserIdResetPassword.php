<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Set up a new password for the user.
 *
 * Maps to PUT /admin/realms/{realm}/users/{user-id}/reset-password in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmUsersUserIdResetPassword extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_users_user_id_reset_password',
  'class' => 'KeycloakPutAdminRealmsRealmUsersUserIdResetPassword',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/users/{user-id}/reset-password',
  'summary' => 'Set up a new password for the user',
  'description' => 'Set up a new password for the user.',
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
    'body' =>
    array (
      'type' => 'object',
      'required' => false,
      'description' => 'Request body matching the official Keycloak Admin REST API schema for this endpoint.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'user-id' => 'user_id',
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
