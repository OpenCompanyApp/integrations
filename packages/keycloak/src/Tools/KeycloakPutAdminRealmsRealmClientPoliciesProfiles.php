<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * PUT /admin/realms/{realm}/client-policies/profiles.
 *
 * Maps to PUT /admin/realms/{realm}/client-policies/profiles in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmClientPoliciesProfiles extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_client_policies_profiles',
  'class' => 'KeycloakPutAdminRealmsRealmClientPoliciesProfiles',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/client-policies/profiles',
  'summary' => 'PUT /admin/realms/{realm}/client-policies/profiles',
  'description' => 'PUT /admin/realms/{realm}/client-policies/profiles.',
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
