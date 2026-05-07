<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Delete an authentication flow.
 *
 * Maps to DELETE /admin/realms/{realm}/authentication/flows/{id} in the official Keycloak Admin REST API.
 */
class KeycloakDeleteAdminRealmsRealmAuthenticationFlowsId extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_delete_admin_realms_realm_authentication_flows_id',
  'class' => 'KeycloakDeleteAdminRealmsRealmAuthenticationFlowsId',
  'method' => 'DELETE',
  'path' => '/admin/realms/{realm}/authentication/flows/{id}',
  'summary' => 'Delete an authentication flow',
  'description' => 'Delete an authentication flow.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'id' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'Flow id',
    ),
  ),
  'path_params' =>
  array (
    'realm' => 'realm',
    'id' => 'id',
  ),
  'query_params' =>
  array (
  ),
  'header_params' =>
  array (
  ),
  'body_required' => false,
  'content_type' => NULL,
  'type' => 'write',
);
}
