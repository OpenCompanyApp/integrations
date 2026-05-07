<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get social logins associated with the user.
 *
 * Maps to GET /admin/realms/{realm}/users/{user-id}/federated-identity in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmUsersUserIdFederatedIdentity extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_users_user_id_federated_identity',
  'class' => 'KeycloakGetAdminRealmsRealmUsersUserIdFederatedIdentity',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/users/{user-id}/federated-identity',
  'summary' => 'Get social logins associated with the user',
  'description' => 'Get social logins associated with the user.',
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
