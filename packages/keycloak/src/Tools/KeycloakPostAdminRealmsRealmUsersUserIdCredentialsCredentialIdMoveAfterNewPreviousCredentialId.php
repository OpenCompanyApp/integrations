<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Move a credential to a position behind another credential.
 *
 * Maps to POST /admin/realms/{realm}/users/{user-id}/credentials/{credentialId}/moveAfter/{newPreviousCredentialId} in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmUsersUserIdCredentialsCredentialIdMoveAfterNewPreviousCredentialId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_users_user_id_credentials_credential_id_move_after_new_previous_credential_id',
  'class' => 'KeycloakPostAdminRealmsRealmUsersUserIdCredentialsCredentialIdMoveAfterNewPreviousCredentialId',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/users/{user-id}/credentials/{credentialId}/moveAfter/{newPreviousCredentialId}',
  'summary' => 'Move a credential to a position behind another credential',
  'description' => 'Move a credential to a position behind another credential.',
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
    'new_previous_credential_id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'The credential that will be the previous element in the list. If set to null, the moved credential will be the first element in the list.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'user-id' => 'user_id',
    'credentialId' => 'credential_id',
    'newPreviousCredentialId' => 'new_previous_credential_id',
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
