<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Move a credential to a first position in the credentials list of the user.
 *
 * Maps to POST /admin/realms/{realm}/users/{user-id}/credentials/{credentialId}/moveToFirst in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmUsersUserIdCredentialsCredentialIdMoveToFirst extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_users_user_id_credentials_credential_id_move_to_first',
  'class' => 'KeycloakPostAdminRealmsRealmUsersUserIdCredentialsCredentialIdMoveToFirst',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/users/{user-id}/credentials/{credentialId}/moveToFirst',
  'summary' => 'Move a credential to a first position in the credentials list of the user',
  'description' => 'Move a credential to a first position in the credentials list of the user.',
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
      'description' => 'The credential to move',
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
