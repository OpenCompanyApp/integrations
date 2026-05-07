<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * List identity providers.
 *
 * Maps to GET /admin/realms/{realm}/identity-provider/instances in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmIdentityProviderInstances extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_identity_provider_instances',
  'class' => 'KeycloakGetAdminRealmsRealmIdentityProviderInstances',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/identity-provider/instances',
  'summary' => 'List identity providers',
  'description' => 'List identity providers.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'brief_representation' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Boolean which defines whether brief representations are returned (default: false)',
    ),
    'capability' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Filter by identity providers capability',
    ),
    'first' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Pagination offset',
    ),
    'max' =>
    array (
      'type' => 'integer',
      'required' => false,
      'description' => 'Maximum results size (defaults to 100)',
    ),
    'realm_only' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Boolean which defines if only realm-level IDPs (not associated with orgs) should be returned (default: false)',
    ),
    'search' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Filter specific providers by name. Search can be prefix (name*), contains (*name*) or exact ("name"). Default prefixed.',
    ),
    'type' =>
    array (
      'type' => 'string',
      'required' => false,
      'description' => 'Filter by identity providers type',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
  ),
  'query_params' =>
  array (
    'briefRepresentation' => 'brief_representation',
    'capability' => 'capability',
    'first' => 'first',
    'max' => 'max',
    'realmOnly' => 'realm_only',
    'search' => 'search',
    'type' => 'type',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
