<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * PUT /admin/realms/{realm}/users/profile.
 *
 * Maps to PUT /admin/realms/{realm}/users/profile in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmUsersProfile extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_users_profile',
  'class' => 'KeycloakPutAdminRealmsRealmUsersProfile',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/users/profile',
  'summary' => 'PUT /admin/realms/{realm}/users/profile',
  'description' => 'Set the configuration for the user profile',
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
