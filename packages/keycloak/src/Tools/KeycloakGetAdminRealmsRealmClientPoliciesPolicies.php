<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * GET /admin/realms/{realm}/client-policies/policies.
 *
 * Maps to GET /admin/realms/{realm}/client-policies/policies in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientPoliciesPolicies extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_client_policies_policies',
  'class' => 'KeycloakGetAdminRealmsRealmClientPoliciesPolicies',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/client-policies/policies',
  'summary' => 'GET /admin/realms/{realm}/client-policies/policies',
  'description' => 'GET /admin/realms/{realm}/client-policies/policies.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'include_global_policies' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Official Keycloak query parameter `include-global-policies`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
  ),
  'query_params' =>
  array (
    'include-global-policies' => 'include_global_policies',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
