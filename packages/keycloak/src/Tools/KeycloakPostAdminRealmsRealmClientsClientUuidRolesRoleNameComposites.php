<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Add a composite to the role.
 *
 * Maps to POST /admin/realms/{realm}/clients/{client-uuid}/roles/{role-name}/composites in the official Keycloak Admin REST API.
 */
class KeycloakPostAdminRealmsRealmClientsClientUuidRolesRoleNameComposites extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_post_admin_realms_realm_clients_client_uuid_roles_role_name_composites',
  'class' => 'KeycloakPostAdminRealmsRealmClientsClientUuidRolesRoleNameComposites',
  'method' => 'POST',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/roles/{role-name}/composites',
  'summary' => 'Add a composite to the role',
  'description' => 'Add a composite to the role.',
  'parameters' =>
  array (
    'realm' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'realm name (not id!)',
    ),
    'client_uuid' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'id of client (not client-id!)',
    ),
    'role_name' =>
    array (
      'type' => 'string',
      'required' => true,
      'description' => 'role\'s name (not id!)',
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
    'client-uuid' => 'client_uuid',
    'role-name' => 'role_name',
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
