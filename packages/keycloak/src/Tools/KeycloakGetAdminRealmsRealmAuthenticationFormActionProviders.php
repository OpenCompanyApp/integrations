<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get form action providers Returns a stream of form action providers.
 *
 * Maps to GET /admin/realms/{realm}/authentication/form-action-providers in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmAuthenticationFormActionProviders extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_authentication_form_action_providers',
  'class' => 'KeycloakGetAdminRealmsRealmAuthenticationFormActionProviders',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/authentication/form-action-providers',
  'summary' => 'Get form action providers Returns a stream of form action providers',
  'description' => 'Get form action providers Returns a stream of form action providers.',
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
