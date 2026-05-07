<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * GET /admin/realms/{realm}/client-policies/profiles.
 *
 * Maps to GET /admin/realms/{realm}/client-policies/profiles in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientPoliciesProfiles extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_client_policies_profiles',
  'class' => 'KeycloakGetAdminRealmsRealmClientPoliciesProfiles',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/client-policies/profiles',
  'summary' => 'GET /admin/realms/{realm}/client-policies/profiles',
  'description' => 'GET /admin/realms/{realm}/client-policies/profiles.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'include_global_profiles' =>
    array (
      'type' => 'boolean',
      'required' => false,
      'description' => 'Official Keycloak query parameter `include-global-profiles`.',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
  ),
  'query_params' =>
  array (
    'include-global-profiles' => 'include_global_profiles',
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'read',
);
}
