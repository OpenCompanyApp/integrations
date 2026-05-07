<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Removes all user sessions.
 *
 * Maps to POST /admin/realms/{realm}/logout-all in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmLogoutAll extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_logout_all',
  'class' => 'KeycloakPostAdminRealmsRealmLogoutAll',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/logout-all',
  'summary' => 'Removes all user sessions',
  'description' => 'Any client that has an admin url will also be told to invalidate any sessions they have.',
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
  'type' => 'write',
);
}
