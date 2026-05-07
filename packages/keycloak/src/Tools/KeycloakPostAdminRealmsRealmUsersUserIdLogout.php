<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Remove all user sessions associated with the user Also send notification to all clients that have an admin URL to invalidate the sessions for the particular user.
 *
 * Maps to POST /admin/realms/{realm}/users/{user-id}/logout in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmUsersUserIdLogout extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_users_user_id_logout',
  'class' => 'KeycloakPostAdminRealmsRealmUsersUserIdLogout',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/users/{user-id}/logout',
  'summary' => 'Remove all user sessions associated with the user Also send notification to all clients that have an admin URL to invalidate the sessions for the particular user',
  'description' => 'Remove all user sessions associated with the user Also send notification to all clients that have an admin URL to invalidate the sessions for the particular user.',
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
