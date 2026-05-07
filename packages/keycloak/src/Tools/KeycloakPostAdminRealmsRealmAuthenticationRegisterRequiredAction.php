<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Register a new required actions.
 *
 * Maps to POST /admin/realms/{realm}/authentication/register-required-action in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmAuthenticationRegisterRequiredAction extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_authentication_register_required_action',
  'class' => 'KeycloakPostAdminRealmsRealmAuthenticationRegisterRequiredAction',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/authentication/register-required-action',
  'summary' => 'Register a new required actions',
  'description' => 'Register a new required actions.',
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
