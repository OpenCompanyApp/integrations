<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Add a social login provider to the user.
 *
 * Maps to POST /admin/realms/{realm}/users/{user-id}/federated-identity/{provider} in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmUsersUserIdFederatedIdentityProvider extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_users_user_id_federated_identity_provider',
  'class' => 'KeycloakPostAdminRealmsRealmUsersUserIdFederatedIdentityProvider',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/users/{user-id}/federated-identity/{provider}',
  'summary' => 'Add a social login provider to the user',
  'description' => 'Add a social login provider to the user.',
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
    'provider' => 'provider',
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
