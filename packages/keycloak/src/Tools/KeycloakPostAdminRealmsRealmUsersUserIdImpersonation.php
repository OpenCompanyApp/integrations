<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Impersonate the user.
 *
 * Maps to POST /admin/realms/{realm}/users/{user-id}/impersonation in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmUsersUserIdImpersonation extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_users_user_id_impersonation',
  'class' => 'KeycloakPostAdminRealmsRealmUsersUserIdImpersonation',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/users/{user-id}/impersonation',
  'summary' => 'Impersonate the user',
  'description' => 'Impersonate the user.',
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
  'type' => 'write',
);
}
