<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Update a credential label for a user.
 *
 * Maps to PUT /admin/realms/{realm}/users/{user-id}/credentials/{credentialId}/userLabel in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmUsersUserIdCredentialsCredentialIdUserLabel extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_users_user_id_credentials_credential_id_user_label',
  'class' => 'KeycloakPutAdminRealmsRealmUsersUserIdCredentialsCredentialIdUserLabel',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/users/{user-id}/credentials/{credentialId}/userLabel',
  'summary' => 'Update a credential label for a user',
  'description' => 'Update a credential label for a user.',
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
    'credentialId' => 'credential_id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => 'text/plain',
  'type' => 'write',
);
}
