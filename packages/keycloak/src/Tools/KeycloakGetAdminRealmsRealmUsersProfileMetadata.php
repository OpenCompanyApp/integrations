<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * GET /admin/realms/{realm}/users/profile/metadata.
 *
 * Maps to GET /admin/realms/{realm}/users/profile/metadata in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmUsersProfileMetadata extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_users_profile_metadata',
  'class' => 'KeycloakGetAdminRealmsRealmUsersProfileMetadata',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/users/profile/metadata',
  'summary' => 'GET /admin/realms/{realm}/users/profile/metadata',
  'description' => 'Get the UserProfileMetadata from the configuration',
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
