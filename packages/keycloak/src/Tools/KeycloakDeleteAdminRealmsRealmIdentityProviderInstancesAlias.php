<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Delete the identity provider.
 *
 * Maps to DELETE /admin/realms/{realm}/identity-provider/instances/{alias} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmIdentityProviderInstancesAlias extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_identity_provider_instances_alias',
  'class' => 'KeycloakDeleteAdminRealmsRealmIdentityProviderInstancesAlias',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/identity-provider/instances/{alias}',
  'summary' => 'Delete the identity provider',
  'description' => 'Delete the identity provider.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'alias' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Official Keycloak path parameter `alias`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'alias' => 'alias',
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
