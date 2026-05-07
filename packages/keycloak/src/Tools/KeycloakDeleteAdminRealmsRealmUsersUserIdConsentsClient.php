<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Revoke consent and offline tokens for particular client from user.
 *
 * Maps to DELETE /admin/realms/{realm}/users/{user-id}/consents/{client} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmUsersUserIdConsentsClient extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_users_user_id_consents_client',
  'class' => 'KeycloakDeleteAdminRealmsRealmUsersUserIdConsentsClient',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/users/{user-id}/consents/{client}',
  'summary' => 'Revoke consent and offline tokens for particular client from user',
  'description' => 'Revoke consent and offline tokens for particular client from user.',
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
    'client' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Client id',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'user-id' => 'user_id',
    'client' => 'client',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
