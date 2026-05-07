<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Base path for retrieve providers with the configProperties properly filled.
 *
 * Maps to GET /admin/realms/{realm}/client-registration-policy/providers in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientRegistrationPolicyProviders extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_client_registration_policy_providers',
  'class' => 'KeycloakGetAdminRealmsRealmClientRegistrationPolicyProviders',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/client-registration-policy/providers',
  'summary' => 'Base path for retrieve providers with the configProperties properly filled',
  'description' => 'Base path for retrieve providers with the configProperties properly filled.',
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
