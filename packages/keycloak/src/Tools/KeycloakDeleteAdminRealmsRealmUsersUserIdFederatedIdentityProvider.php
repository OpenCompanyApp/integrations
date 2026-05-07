<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Remove a social login provider from user.
 *
 * Maps to DELETE /admin/realms/{realm}/users/{user-id}/federated-identity/{provider} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmUsersUserIdFederatedIdentityProvider extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_users_user_id_federated_identity_provider',
  'class' => 'KeycloakDeleteAdminRealmsRealmUsersUserIdFederatedIdentityProvider',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/users/{user-id}/federated-identity/{provider}',
  'summary' => 'Remove a social login provider from user',
  'description' => 'Remove a social login provider from user.',
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
    'provider' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Social login provider id',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'user-id' => 'user_id',
    'provider' => 'provider',
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
