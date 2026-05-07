<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Update a mapper for the identity provider.
 *
 * Maps to PUT /admin/realms/{realm}/identity-provider/instances/{alias}/mappers/{id} in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmIdentityProviderInstancesAliasMappersId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_identity_provider_instances_alias_mappers_id',
  'class' => 'KeycloakPutAdminRealmsRealmIdentityProviderInstancesAliasMappersId',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/identity-provider/instances/{alias}/mappers/{id}',
  'summary' => 'Update a mapper for the identity provider',
  'description' => 'Update a mapper for the identity provider.',
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
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Mapper id',
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
    'id' => 'id',
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
