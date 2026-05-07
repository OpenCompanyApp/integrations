<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Return credential types, which are provided by the user storage where user is stored.
 *
 * Maps to GET /admin/realms/{realm}/users/{user-id}/configured-user-storage-credential-types in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmUsersUserIdConfiguredUserStorageCredentialTypes extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_users_user_id_configured_user_storage_credential_types',
  'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdConfiguredUserStorageCredentialTypes',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/users/{user-id}/configured-user-storage-credential-types',
  'summary' => 'Return credential types, which are provided by the user storage where user is stored',
  'description' => 'Returned values can contain for example "password", "otp" etc. This will always return empty list for "local" users, which are not backed by any user storage',
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
  'content_type' => NULL,
  'type' => 'read',
);
}
