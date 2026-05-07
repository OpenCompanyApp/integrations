<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Remove a credential for a user.
 *
 * Maps to DELETE /admin/realms/{realm}/users/{user-id}/credentials/{credentialId} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmUsersUserIdCredentialsCredentialId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_users_user_id_credentials_credential_id',
  'class' => 'KeycloakDeleteAdminRealmsRealmUsersUserIdCredentialsCredentialId',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/users/{user-id}/credentials/{credentialId}',
  'summary' => 'Remove a credential for a user',
  'description' => 'Remove a credential for a user.',
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
    'credential_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `credentialId`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'user-id' => 'user_id',
    'credentialId' => 'credential_id',
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
