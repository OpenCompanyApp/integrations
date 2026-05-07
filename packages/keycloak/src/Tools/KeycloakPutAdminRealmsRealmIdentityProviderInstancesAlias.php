<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Update the identity provider.
 *
 * Maps to PUT /admin/realms/{realm}/identity-provider/instances/{alias} in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmIdentityProviderInstancesAlias extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_identity_provider_instances_alias',
  'class' => 'KeycloakPutAdminRealmsRealmIdentityProviderInstancesAlias',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/identity-provider/instances/{alias}',
  'summary' => 'Update the identity provider',
  'description' => 'Update the identity provider.',
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
