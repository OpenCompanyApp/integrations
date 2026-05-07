<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get unregistered required actions Returns a stream of unregistered required actions.
 *
 * Maps to GET /admin/realms/{realm}/authentication/unregistered-required-actions in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmAuthenticationUnregisteredRequiredActions extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_authentication_unregistered_required_actions',
  'class' => 'KeycloakGetAdminRealmsRealmAuthenticationUnregisteredRequiredActions',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/authentication/unregistered-required-actions',
  'summary' => 'Get unregistered required actions Returns a stream of unregistered required actions',
  'description' => 'Get unregistered required actions Returns a stream of unregistered required actions.',
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
