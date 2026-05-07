<?php

namespace OpenCompany\Integrations\Keycloak\Tools;

/**
 * Get a user dedicated to the service account.
 *
 * Maps to GET /admin/realms/{realm}/clients/{client-uuid}/service-account-user in the official Keycloak Admin REST API.
 */
class KeycloakGetAdminRealmsRealmClientsClientUuidServiceAccountUser extends AbstractKeycloakTool
{
    protected const OPERATION = array (
  'slug' => 'keycloak_get_admin_realms_realm_clients_client_uuid_service_account_user',
  'class' => 'KeycloakGetAdminRealmsRealmClientsClientUuidServiceAccountUser',
  'method' => 'GET',
  'path' => '/admin/realms/{realm}/clients/{client-uuid}/service-account-user',
  'summary' => 'Get a user dedicated to the service account',
  'description' => 'Get a user dedicated to the service account.',
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
  'content_type' => NULL,
  'type' => 'read',
);
}
