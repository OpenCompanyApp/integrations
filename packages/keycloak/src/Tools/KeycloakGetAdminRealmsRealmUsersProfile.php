<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * GET /admin/realms/{realm}/users/profile.
 *
 * Maps to GET /admin/realms/{realm}/users/profile in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmUsersProfile extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_users_profile',
  'class' => 'KeycloakGetAdminRealmsRealmUsersProfile',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/users/profile',
  'summary' => 'GET /admin/realms/{realm}/users/profile',
  'description' => 'Get the configuration for the user profile',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
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
