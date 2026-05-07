<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Push the realm's revocation policy to any client that has an admin url associated with it.
 *
 * Maps to POST /admin/realms/{realm}/push-revocation in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmPushRevocation extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_push_revocation',
  'class' => 'KeycloakPostAdminRealmsRealmPushRevocation',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/push-revocation',
  'summary' => 'Push the realm\'s revocation policy to any client that has an admin url associated with it',
  'description' => 'Push the realm\'s revocation policy to any client that has an admin url associated with it.',
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
