<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Add a mapper to identity provider.
 *
 * Maps to POST /admin/realms/{realm}/identity-provider/instances/{alias}/mappers in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmIdentityProviderInstancesAliasMappers extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_identity_provider_instances_alias_mappers',
  'class' => 'KeycloakPostAdminRealmsRealmIdentityProviderInstancesAliasMappers',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/identity-provider/instances/{alias}/mappers',
  'summary' => 'Add a mapper to identity provider',
  'description' => 'Add a mapper to identity provider.',
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
    'alias' => 'alias',
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
