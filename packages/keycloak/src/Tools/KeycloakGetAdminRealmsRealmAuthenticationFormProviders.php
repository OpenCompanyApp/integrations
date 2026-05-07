<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get form providers Returns a stream of form providers.
 *
 * Maps to GET /admin/realms/{realm}/authentication/form-providers in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmAuthenticationFormProviders extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_authentication_form_providers',
  'class' => 'KeycloakGetAdminRealmsRealmAuthenticationFormProviders',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/authentication/form-providers',
  'summary' => 'Get form providers Returns a stream of form providers',
  'description' => 'Get form providers Returns a stream of form providers.',
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
