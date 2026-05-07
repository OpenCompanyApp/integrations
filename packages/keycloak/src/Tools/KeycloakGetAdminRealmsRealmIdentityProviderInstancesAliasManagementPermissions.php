<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Return object stating whether client Authorization permissions have been initialized or not and a reference.
 *
 * Maps to GET /admin/realms/{realm}/identity-provider/instances/{alias}/management/permissions in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmIdentityProviderInstancesAliasManagementPermissions extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_identity_provider_instances_alias_management_permissions',
  'class' => 'KeycloakGetAdminRealmsRealmIdentityProviderInstancesAliasManagementPermissions',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/identity-provider/instances/{alias}/management/permissions',
  'summary' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference',
  'description' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference.',
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
  'type' => 'read',
);
}
