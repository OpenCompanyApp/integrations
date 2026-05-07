<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Return object stating whether client Authorization permissions have been initialized or not and a reference.
 *
 * Maps to PUT /admin/realms/{realm}/clients/{client-uuid}/management/permissions in the official Keycloak Admin REST API.
 */
class KeycloakPutAdminRealmsRealmClientsClientUuidManagementPermissions extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_put_admin_realms_realm_clients_client_uuid_management_permissions',
  'class' => 'KeycloakPutAdminRealmsRealmClientsClientUuidManagementPermissions',
  'method' => 'PUT',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/management/permissions',
  'summary' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference',
  'description' => 'Return object stating whether client Authorization permissions have been initialized or not and a reference.',
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
