<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Create a new identity provider.
 *
 * Maps to POST /admin/realms/{realm}/identity-provider/instances in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmIdentityProviderInstances extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_identity_provider_instances',
  'class' => 'KeycloakPostAdminRealmsRealmIdentityProviderInstances',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/identity-provider/instances',
  'summary' => 'Create a new identity provider',
  'description' => 'Create a new identity provider.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
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
