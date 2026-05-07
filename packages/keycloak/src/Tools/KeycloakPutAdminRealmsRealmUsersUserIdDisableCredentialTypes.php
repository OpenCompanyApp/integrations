<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Disable all credentials for a user of a specific type.
 *
 * Maps to PUT /admin/realms/{realm}/users/{user-id}/disable-credential-types in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmUsersUserIdDisableCredentialTypes extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_users_user_id_disable_credential_types',
  'class' => 'KeycloakPutAdminRealmsRealmUsersUserIdDisableCredentialTypes',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/users/{user-id}/disable-credential-types',
  'summary' => 'Disable all credentials for a user of a specific type',
  'description' => 'Disable all credentials for a user of a specific type.',
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
